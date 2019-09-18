<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|sentence方法表示随机获取小段落文本
*/

$factory->define(User::class, function (Faker $faker) {
    $date_time = $faker->date . " ".$faker->time;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$eeOQaMRAxRQ81/i1m7Zy0uTPo6e2PlASZai1BLAXIGpXVzFR7YhC6', // password
        'remember_token' => Str::random(10),
        'introduction' => $faker->sentence(),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
