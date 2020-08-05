<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        '__state' => $faker->word,
        'title' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s')
    ];
});
