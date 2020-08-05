<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\GroupUser;
use Faker\Generator as Faker;

$factory->define(GroupUser::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'groupId' => $faker->word,
        'userId' => $faker->word,
        'leader' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s'),
        '__state' => $faker->word
    ];
});
