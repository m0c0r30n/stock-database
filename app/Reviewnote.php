<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stockchange;

class Reviewnote extends Model
{
    protected $dates = [
        'date',
    ];
    public function stockchange() {
        return $this->hasMany(Stockchange::class,'reviewnote_id')->orderBy('id','asc');
    }
}
