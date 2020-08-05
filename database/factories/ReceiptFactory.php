<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Receipt;
use Faker\Generator as Faker;

$factory->define(Receipt::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'applicationId' => $faker->word,
        'organizationId' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'duration' => $faker->word,
        'userId' => $faker->word,
        'env' => $faker->word,
        'receipt' => $faker->text,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s'),
        'service' => $faker->word,
        'meta' => $faker->word
    ];
});
