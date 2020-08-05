<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'applicationId' => $faker->word,
        'organizationId' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'token' => $faker->word,
        'userId' => $faker->word,
        'env' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s')
    ];
});
