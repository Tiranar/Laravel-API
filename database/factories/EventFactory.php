<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {

    return [
        '__version' => $faker->word,
        'applicationId' => $faker->word,
        'childFirstName' => $faker->word,
        'childId' => $faker->word,
        'ip' => $faker->word,
        'label' => $faker->word,
        'origin' => $faker->word,
        'parentEmail' => $faker->word,
        'parentFirstName' => $faker->word,
        'parentId' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'time' => $faker->word,
        'useragent' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s')
    ];
});
