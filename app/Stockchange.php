<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reviewnote;

class Stockchange extends Model
{
    protected $fillable=['title','topfifteen_id','chartpicture','description'];

    public function reviewnote() {
        return $this->belongTo(Reviewnote::class,'reviewnote_id');
    }
}
