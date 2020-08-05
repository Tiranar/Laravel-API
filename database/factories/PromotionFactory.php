<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Promotion;
use Faker\Generator as Faker;

$factory->define(Promotion::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'applicationId' => $faker->word,
        'organizationId' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'expiration' => $faker->date('Y-m-d H:i:s'),
        'userId' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s')
    ];
});
