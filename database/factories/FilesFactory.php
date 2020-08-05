<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Files;
use Faker\Generator as Faker;

$factory->define(Files::class, function (Faker $faker) {

    return [
        'src' => $faker->imageUrl(),
        'thumbnail' => $faker->imageUrl(100, 100)
    ];
});
