<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Stock;
use App\Indexes;

class MakeIrekaePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;
    public $irekae_kensho;
    public $irekae_stock;
    public $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $irekae_kensho, $irekae_stock, $nikkei_datas, $mothers_datas, $text)
    {
        $this->id = $id;
        $this->irekae_kensho = $irekae_kensho;
        $this->irekae_stock = $irekae_stock;
        $this->nikkei_datas = $nikkei_datas;
        $this->mothers_datas = $mothers_datas;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $location = storage_path() . '/pdf/';
        $week_day = date('w', strtotime($this->irekae_kensho->date));
        $week = array( "日", "月", "火", "水", "木", "金", "月" );
        $stock_name = [];
        $nikkei = [];
        $mothers = [];

        foreach ($this->irekae_kensho->date as $d) {
            $tomorrow = date("Y-m-d", $d.strtotime("+1 day"));
            $nikkei_tmp = Indexes::where([
                ['stock_number', '=', 1],
                ['date', '=', $tomorrow],
            ])->first();
            $mothers_tmp = Indexes::where([
                ['stock_number', '=', 12],
                ['date', '=', $tomorrow],
            ])->first();
            array_push($nikkei, $nikkei_tmp);
            array_push($mothers, $mothers_tmp);
        }

        foreach ($this->irekae_stock as $v) {
            $tmp = Stock::where('code', $v->stock_number)->first();
            array_push($stock_name, $tmp->name);
        }
        
        $filename = $this->irekae_kensho->date->format('Y_m_d').'_irekae_note.pdf';
        $pdf = \PDF::loadView('makepdf.irekaenote',['id' => $this->id, 'stock_name' => $stock_name, 'irekae_kensho' => $this->irekae_kensho, 'irekae_stock' => $this->irekae_stock, 'nikkei_datas' => $nikkei, 'mothers_datas' => $mothers, 'youbi' => $week[$week_day]])
            ->setOption('encoding', 'utf-8')
            ->setOption('user-style-sheet', base_path() . '/public/css/irekae_pdf.css');

        $pdf->save($location . $filename, true);
        \Storage::disk('s3')->putFileAs('pdf/', $location . $filename, $filename, 'public');
    }
}
