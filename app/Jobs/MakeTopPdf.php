<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class MakeTopPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;
    public $top_fifteen;
    public $stock_info;
    public $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $top_fifteen, $stock_info, $text)
    {
        $this->id = $id;
        $this->top_fifteen = $top_fifteen;
        $this->stock_info = $stock_info;
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
        $filename = $this->top_fifteen->created_at->format('Y_m_d').'_top_note.pdf';
        $pdf = \PDF::loadView('makepdf.topnote',['id' => $this->id, 'top_fifteen' => $this->top_fifteen, 'stock_info' => $this->stock_info])
            ->setOption('encoding', 'utf-8')
            ->setOption('user-style-sheet', base_path() . '/public/css/top_pdf.css');

        $pdf->save($location . $filename, true);
        \Storage::disk('s3')->putFileAs('pdf/', $location . $filename, $filename, 'public');
    }
}
