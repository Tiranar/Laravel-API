<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Items;
use Faker\Generator as Faker;

$types = ['lizard', 'cat', 'dog'];

$factory->define(Items::class, function (Faker $faker) use ($types) {

    return [
        'type' => $types[array_rand($types)],
        'name' => $faker->word,
        'cost' => random_int(1, 999),
        '__version' => '1.0.0',
        'short_description' => $faker->sentence(),
        'description' => $faker->text()
    ];
});
