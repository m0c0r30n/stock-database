<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Irekaestock;

class Irekaekensho extends Model
{
    protected $dates = ['date'];

    public function irekaestocks() {
        return $this->hasMany(Irekaestock::class,'irekaekensho_id')->orderBy('id','asc');
    }
}

