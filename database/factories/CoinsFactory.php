<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Coins;
use Faker\Generator as Faker;

$factory->define(Coins::class, function (Faker $faker) {

    return [
        'id' => $faker->word,
        'user_id' => rand(1, 10),
        'addCoins' => rand(100, 200),
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s'),
    ];
});
