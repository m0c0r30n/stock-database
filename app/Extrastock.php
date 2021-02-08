<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Topfifteen;
use App\Extrastock;

class Extrastock extends Model
{
    protected $fillable=['stock_number','stock_name'];

    protected $dates = [
        'date',
    ];
    public function extrastock() {
        return $this->belongTo(Topfifteen::class,'topfifteen_id');
    }
}

