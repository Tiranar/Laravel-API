<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AuthToken;
use Faker\Generator as Faker;

$factory->define(AuthToken::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'organizationId' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s'),
        '__state' => $faker->word
    ];
});
