<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Projects\Entities\Project::class, function (Faker $faker) {
        return [
        'code' => generateCode('projects'),
        'name' => $faker->company.' Project',
        'currency' => 'USD',
        'description' => $faker->text(800),
        'client_id' => $faker->numberBetween(1, 10),
        'estimate_hours' => $faker->randomFloat(2, 30, 100),
        'hourly_rate' => $faker->randomFloat(2, 10, 100),
        'start_date' => now(),
        'due_date' => now()->addDays(rand(3, 90)),
        'progress' => 0,
        'manager' => 1,
        ];
    }
);
