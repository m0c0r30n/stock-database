<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Topfifteen;
use App\Stockinfo;

class Stockinfo extends Model
{
    protected $fillable=['topfifteen_id','dekidaka','overunder','chart_picture','description'];

    public function topfif() {
        return $this->belongTo(Topfifteen::class,'topfifteen_id');
    }
}
