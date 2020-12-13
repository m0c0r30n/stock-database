<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Stockinfo;
use App\Lionnote;


class Topfifteen extends Model
{
    public function stocks() {
        return $this->hasMany(Stockinfo::class,'topfifteen_id')->orderBy('id','asc');
    }
}
