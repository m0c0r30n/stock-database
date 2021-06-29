<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexes extends Model
{
    // protected $fillable=['stock_number','date','openprice','endprice', 'highprice','lowprice', 'increase_rate', 'dekidaka'];

    // public function stockdatabase() {
    //     return $this->belongTo(Stockdatabase::class,'stockdatabase_id');
    // }
    public function user()
    {
        return $this->hasOne(config('admin.database.users_model'), 'id', 'user_id');
    }
}
