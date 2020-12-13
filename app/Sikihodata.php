<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Stockdatabase;
use App\Sikihodata;

class Sikihodata extends Model
{
    protected $fillable=['sikiho_title','stockdatabase_id','sikiho_year_season','characteristic', 'perspective'];

    public function stockdatabase() {
        return $this->belongTo(Stockdatabase::class,'stockdatabase_id');
    }
}
