<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;


use App\Sikihodata;
use App\Stock;
use App\Stockdatabase;
use App\Stockinfo;
use App\Stockchange;
use App\Topfifteen;
use App\WadaiData;
use App\Lionnote;

class StockDatabaseController extends Controller
{
    private static function isMobileOrPc($request): string
    {
        $user_agent =  $request->header('User-Agent');
        if ((strpos($user_agent, 'iPhone') !== false)
            || (strpos($user_agent, 'iPod') !== false)
            || (strpos($user_agent, 'Android') !== false)) {
            return 'mobile';
        } else {
            return 'pc';
        }
    }

    public function index() {
        $sikiho_datas = Sikihodata::inRandomOrder()->get();
        $stock_infos = Stockinfo::inRandomOrder()->get();
        //wadai_dataの重複削除
        $wadai_datas = WadaiData::latest()->get();
        
        $tmp = array();
        $array_result = array();
        foreach($wadai_datas as $v) {
            if(!in_array($v['stock_number'], $tmp)) {
                $tmp[] = $v['stock_number'];
                $array_result[] = $v;
            }
        }
        $wadai_datas = $array_result;
        //////////////////////
        $topfifteen_datas = Topfifteen::latest()->get();
        $stockchange_datas = Stockchange::latest()->get();
        
        return view('stockdatabase.index', ["topfifteen_datas" => $topfifteen_datas, "wadai_datas" => $wadai_datas, "stockchange_datas" => $stockchange_datas]);
    }

    public function detail($stock_number) {
        $stocks = Stock::where('code', $stock_number)->get();
        $sikiho_datas = Sikihodata::latest()->where('stock_number', $stock_number)->get();
        $indivilions = Stockinfo::latest()->where('stock_number', $stock_number)->get();
        $wadai_datas = WadaiData::where('stock_number', $stock_number)->orderBy('date', 'desc')->withCasts(['date' => 'date'])->get();
        $lion_notes = Lionnote::where('stock_number', $stock_number)->orderBy('date', 'desc')->withCasts(['date' => 'date'])->get();
        return view('stockdatabase.detail', ["stocks" => $stocks, "sikiho_datas" => $sikiho_datas, "wadai_datas" => $wadai_datas, "indivilions" => $indivilions]);
    }

}
