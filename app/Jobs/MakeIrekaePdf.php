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
    public function __construct($id, $irekae_kensho, $irekae_stock, $text)
    {
        $this->id = $id;
        $this->irekae_kensho = $irekae_kensho;
        $this->irekae_stock = $irekae_stock;
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
        $week_day = date('w', strtotime($this->irekae_kensho->hizuke));
        
        $week = array( "日", "月", "火", "水", "木", "金", "月" );
        $stock_name = [];
        $nikkei = [];
        $mothers = [];

        $irekae_date = explode('T', $this->irekae_kensho->toArray()["hizuke"])[0];

        $today = date('Y-m-d',strtotime($irekae_date));
        
        if (intval($week_day) == 5) {
            $tomorrow = date('Y-m-d',strtotime($irekae_date . "+3 day"));

        } else {
            $tomorrow = date('Y-m-d',strtotime($irekae_date . "+1 day"));
        }

        $nikkei_today = Indexes::where([
            ['stock_number', '=', 1],
            ['date', '=', $today],
        ])->first();
        $mothers_today = Indexes::where([
            ['stock_number', '=', 12],
            ['date', '=', $today],
        ])->first();

        $nikkei = Indexes::where([
            ['stock_number', '=', 1],
            ['date', '=', $tomorrow],
        ])->first();
        $mothers = Indexes::where([
            ['stock_number', '=', 12],
            ['date', '=', $tomorrow],
        ])->first();

        $nikkei_pastprice = $nikkei_today->toArray()["endprice"];
        $mothers_pastprice = $mothers_today->toArray()["endprice"];
        
        $nikkei = $nikkei->toArray();
        $mothers = $mothers->toArray();

        foreach ($this->irekae_stock as $v) {
            $tmp = Stock::where('code', $v->stock_number)->first();
            array_push($stock_name, $tmp->name);
        }
        $date_array = $this->irekae_kensho->hizuke->toArray();

        $filename = "${date_array['year']}_${date_array['month']}_${date_array['day']}_irekae_note.pdf";
        
        $pdf = \PDF::loadView('makepdf.irekaenote',['id' => $this->id, 'stock_name' => $stock_name, 'irekae_kensho' => $this->irekae_kensho, 'irekae_stock' => $this->irekae_stock, 'nikkei_datas' => $nikkei, 'mothers_datas' => $mothers, 'nikkei_pastprice' => $nikkei_pastprice, 'mothers_pastprice' => $mothers_pastprice, 'youbi' => $week[$week_day]])
            ->setOption('encoding', 'utf-8')
            ->setOption('user-style-sheet', base_path() . '/public/css/irekae_pdf.css');

        $pdf->save($location . $filename, true);
        \Storage::disk('s3')->putFileAs('pdf/', $location . $filename, $filename, 'public');
    }
}
