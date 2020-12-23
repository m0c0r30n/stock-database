<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class MakeReviewPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;
    public $review_note;
    public $stock_change;
    public $week_day;
    public $week_day2;
    public $null_num;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $review_note, $stock_change, $week_day, $week_day2, $null_num)
    {
        $this->id = $id;
        $this->review_note = $review_note;
        $this->stock_change = $stock_change;
        $this->week_day = $week_day;
        $this->week_day2 = $week_day2;
        $this->null_num = $null_num;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $location = storage_path() . '/pdf/';
        $filename = $this->review_note->created_at->format('Y_m_d').'_review_note.pdf';
        $pdf = \PDF::loadView('makepdf.reviewnote', ['pages' => range(1, 6)], ['id' => $this->id, 'review_note' => $this->review_note, 'stock_change' => $this->stock_change, 'week_day' => $this->week_day, 'week_day2' => $this->week_day2, 'null_num' => $this->null_num])
            ->setOption('encoding', 'utf-8')
            ->setOption('user-style-sheet', base_path() . '/public/css/review_pdf.css');
        $pdf->save($location . $filename, true);
        \Storage::disk('s3')->putFileAs('pdf/', $location . $filename, $filename, 'public');
    }
}
