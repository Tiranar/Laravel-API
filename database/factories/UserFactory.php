<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'id' => $faker->word,
        '__version' => $faker->word,
        'avatar' => $faker->word,
        'character' => $faker->word,
        'sid' => $faker->word,
        'status' => $faker->word,
        'firstName' => $faker->word,
        'furthestFloor' => $faker->word,
        'furthestInteraction' => $faker->word,
        'furthestLesson' => $faker->word,
        'name' => $faker->word,
        'email' => $faker->word,
        'trigger_elevator_first' => $faker->word,
        'trigger_fp_room_first' => $faker->word,
        'trigger_lobby_first' => $faker->word,
        'trigger_mf_first' => $faker->word,
        'trigger_trophy_room_first' => $faker->word,
        'deviceGeneration' => $faker->word,
        'hash' => $faker->word,
        'osVersion' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'updatedAt' => $faker->date('Y-m-d H:i:s'),
        'lastDiskSpaceWarning' => $faker->date('Y-m-d H:i:s'),
        'passwordResetToken' => $faker->word,
        '__state' => $faker->word,
        'applicationId' => $faker->word,
        'applicationSecret' => $faker->word,
        'receipt' => $faker->word,
        'organizationId' => $faker->word
    ];
});
