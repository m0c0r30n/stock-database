<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  // /**
  //    * モデルの「初期起動」メソッド
  //    *
  //    * @return void
  //    */
  //   protected static function boot()
  //   {
  //       parent::boot();
  //
  //       static::addGlobalScope('user_id', function (Builder $builder) {
  //           $builder->where('user_id', auth('admin')->user()->id);
  //       });
  //   }
  //
    /**
     * ユーザーに関連する情報を取得
     */
    public function user()
    {
        return $this->hasOne(config('admin.database.users_model'), 'id', 'user_id');
    }
}
