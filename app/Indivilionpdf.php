<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Indivilionpdf extends Model
{
    public function user()
  {
      return $this->hasOne(config('admin.database.users_model'), 'id', 'user_id');
  }
}
