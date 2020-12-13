<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Topfifteen;
use App\Stockinfo;

class Stockinfo extends Model
{
    protected $fillable=['title','topfifteen_id','dekidaka','overunder','chartpicture','description'];

    public function topfif() {
        return $this->belongTo(Topfifteen::class,'topfifteen_id');
    }
}
