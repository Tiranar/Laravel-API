<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'title' => $faker->word,
        'organizationId' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s'),
        '__state' => $faker->word,
        'applicationId' => $faker->word,
        'applicationSecret' => $faker->word
    ];
});
