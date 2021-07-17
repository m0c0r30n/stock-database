<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Jobs\MakeTopPdf;
use App\Jobs\MakeReviewPdf;
use App\Jobs\MakeIrekaePdf;

use App\Reviewnote;
use App\Stockchange;
use App\Topfifteen;
use App\Stockinfo;
use App\Irekaekensho;
use App\Irekaestock;


class MakePdfController extends Controller
{
    public function index($id)
    {
        $review_note = Reviewnote::find($id);
        $week_day = date('w', strtotime($review_note->date));
        $week = array( "日", "月", "火", "水", "木", "金", "月" );
        $stock_change = Stockchange::where('reviewnote_id', '=', $id)->first();
        $null_num  = 26;
        for ($i=1; $i<=25; $i++) {
            if ($stock_change["stock".$i] === Null) {
                $null_num = $i;
                break;
            }
        }
        if (isset($null_num)) {
            $this->dispatch(new MakeReviewPdf($id, $review_note, $stock_change, $week[$week_day], $week[$week_day+1], $null_num));
        } else {
            $this->dispatch(new MakeReviewPdf($id, $review_note, $stock_change, $week[$week_day], $week[$week_day+1]));
        }
        $created_at = $review_note['created_at']->format('Y_m_d');
        return view('makepdf.reviewpdf_download', ['created_at' => $created_at]);
        

        // if (isset($null_num)) {
        //     $pdf = \PDF::loadView('makepdf.reviewnote', ['pages' => range(1, 6)], ['id' => $id, 'review_note' => $review_note, 'stock_change' => $stock_change, 'week_day' => $week[$week_day], 'week_day2' => $week[$week_day+1], 'null_num' => $null_num])
        //     ->setOption('encoding', 'utf-8')
        //     ->setOption('user-style-sheet', base_path() . '/public/css/review_pdf.css');
        // } else {
        //     $pdf = \PDF::loadView('makepdf.reviewnote', ['pages' => range(1, 6)], ['id' => $id, 'review_note' => $review_note, 'stock_change' => $stock_change, 'week_day' => $week[$week_day], 'week_day2' => $week[$week_day+1]])
        //     ->setOption('encoding', 'utf-8')
        //     ->setOption('user-style-sheet', base_path() . '/public/css/review_pdf.css');
        // }
        // return view('makepdf.index', ['id' => $id, 'review_note' => $review_note, 'stock_chage' => $stock_change]);
    }

    public function top($id)
    {
        $top_fifteen = Topfifteen::find($id);
        $stock_info = Stockinfo::where('topfifteen_id', '=', $id)->orderBy('stock_ranking', 'desc')->get();
        $this->dispatch(new MakeTopPdf($id, $top_fifteen, $stock_info, "hogehoge"));
        $created_at = $top_fifteen['created_at']->format('Y_m_d');
        return view('makepdf.pdf_download', ['created_at' => $created_at]);
    }

    public function irekae($id)
    {
        $irekae_kensho = Irekaekensho::find($id);
        $irekae_stock = Irekaestock::where('irekaekensho_id', '=', $id)->get();
        
        $this->dispatch(new MakeIrekaePdf($id, $irekae_kensho, $irekae_stock, "hogehoge"));
        $created_at = $irekae_kensho['created_at']->format('Y_m_d');
        return view('makepdf.pdf_download', ['created_at' => $created_at]);
    }
}