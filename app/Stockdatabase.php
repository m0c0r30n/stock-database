<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Stockdatabase;
use App\Sikihodata;


class Stockdatabase extends Model
{
    public function sikiho() {
        return $this->hasMany(Sikihodata::class,'stockdatabase_id')->orderBy('id','asc');
    }
}
