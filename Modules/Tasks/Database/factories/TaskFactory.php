<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Tasks\Entities\Task::class, function (Faker $faker) {
        return [
        'name' => $faker->company.' Task',
        'description' => $faker->text(300),
        'project_id' => $faker->numberBetween(1, 10),
        'visible' => $faker->numberBetween(0, 1),
        'start_date' => now()->addDays(rand(1, 14)),
        'due_date' => now()->addDays(rand(14, 60)),
        'hourly_rate' => $faker->randomFloat(2, 0, 10),
        'progress' => $faker->numberBetween(0, 100),
        'user_id' => 1,
        ];
    }
);
