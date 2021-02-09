<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  /**
   * ユーザーに関連する情報を取得
   */
  public function user()
  {
      return $this->hasOne(config('admin.database.users_model'), 'id', 'user_id');
  }
}
