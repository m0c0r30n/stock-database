<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Stock;

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
        $week_day = date('w', strtotime($irekae_kensho->date));
        $week = array( "日", "月", "火", "水", "木", "金", "月" );
        $stock_name = [];
        foreach ($this->irekae_stock as $v) {
            $tmp = Stock::where('stock_number', $v->stock_number)->first()
            var_dump($tmp);exit();
            array_push($stock_name, $tmp);
        }
        
        $filename = $this->irekae_kensho->date->format('Y_m_d').'_irekae_note.pdf';
        $pdf = \PDF::loadView('makepdf.irekaenote',['id' => $this->id, 'stock_name' => $stock_name, 'irekae_kensho' => $this->irekae_kensho, 'irekae_stock' => $this->irekae_stock, 'youbi' => $week[$week_day]])
            ->setOption('encoding', 'utf-8')
            ->setOption('user-style-sheet', base_path() . '/public/css/irekae_pdf.css');

        $pdf->save($location . $filename, true);
        \Storage::disk('s3')->putFileAs('pdf/', $location . $filename, $filename, 'public');
    }
}
