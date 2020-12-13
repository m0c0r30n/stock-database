<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
      // devユーザーの指定
      'user_id' => function () {
          return config('admin.database.users_model')::where('username','puchu')->first()->id;
      },
      'title' => $faker->unique()->name,
      'detail' => $faker->text(200)
    ];
});
