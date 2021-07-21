<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Irekaekensho;

class Irekaestock extends Model
{
    protected $fillable=['irekaekensho_id','stock_number','irekae_before','irekae_after','info', 'result'];

    public $timestamps = false;
    
    public function irekaekensho() {
        return $this->belongTo(Irekaekensho::class,'irekaekensho_id');
    }
}
