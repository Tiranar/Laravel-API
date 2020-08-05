<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrganizationUser;
use Faker\Generator as Faker;

$factory->define(OrganizationUser::class, function (Faker $faker) {

    return [
        'userId' => $faker->word,
        'organizationId' => $faker->word
    ];
});
