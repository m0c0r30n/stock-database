<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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
        $filename = $this->irekae_kensho->date->format('Y_m_d').'_irekae_note.pdf';
        $pdf = \PDF::loadView('makepdf.irekaenote',['id' => $this->id, 'irekae_kensho' => $this->irekae_kensho, 'irekae_stock' => $this->irekae_stock])
            ->setOption('encoding', 'utf-8')
            ->setOption('user-style-sheet', base_path() . '/public/css/irekae_pdf.css');

        $pdf->save($location . $filename, true);
        \Storage::disk('s3')->putFileAs('pdf/', $location . $filename, $filename, 'public');
    }
}
