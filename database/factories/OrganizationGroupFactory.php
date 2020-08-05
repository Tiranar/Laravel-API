<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrganizationGroup;
use Faker\Generator as Faker;

$factory->define(OrganizationGroup::class, function (Faker $faker) {

    return [
        'groupId' => $faker->word,
        'organizationId' => $faker->word
    ];
});
