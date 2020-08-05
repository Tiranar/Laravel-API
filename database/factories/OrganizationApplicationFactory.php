<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrganizationApplication;
use Faker\Generator as Faker;

$factory->define(OrganizationApplication::class, function (Faker $faker) {

    return [
        'applicationId' => $faker->word,
        'organizationId' => $faker->word,
        '__state' => $faker->word
    ];
});
