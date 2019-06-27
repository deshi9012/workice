<?php

use Faker\Generator as Faker;

$ar = ['Planning', 'Design', 'Development', 'Launch', 'Follow Up','Research'];
$factory->define(
    Modules\Milestones\Entities\Milestone::class,
    function (Faker $faker) use ($ar) {
        return [
        'milestone_name' => array_random($ar),
        'description' => $faker->paragraph,
        'start_date' => today(),
        'due_date' => now()->addDays(rand(3, 30))
        ];
    }
);
