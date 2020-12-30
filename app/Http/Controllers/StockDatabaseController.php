<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;


use App\Sikihodata;
use App\Stockinfo;
use App\WadaiData;

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
        $wadai_data = WadaiData::inRandomOrder()->get();

        var_dump($wadai_data);exit();

        return view('stockdatabase.index', ["sikiho_datas" => $sikiho_datas]);
    }

}
