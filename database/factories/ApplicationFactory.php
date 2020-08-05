<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Application;
use Faker\Generator as Faker;

$factory->define(Application::class, function (Faker $faker) {

    return [
        '__state' => $faker->word,
        '__version' => $faker->word,
        'title' => $faker->word,
        'secret' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'hostnames' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s')
    ];
});
