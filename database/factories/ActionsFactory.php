<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Actions;
use Faker\Generator as Faker;

$factory->define(Actions::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'authenticated' => $faker->word,
        'email' => $faker->word,
        '__state' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'organizationId' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'updatedAt' => $faker->date('Y-m-d H:i:s'),
        'username' => $faker->word
    ];
});
