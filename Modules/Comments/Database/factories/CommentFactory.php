<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Comments\Entities\Comment::class, function (Faker $faker) {
        return [
        'parent' => 0,
        'user_id' => $faker->numberBetween(1, 10),
        'message' => $faker->paragraph
        ];
    }
);
