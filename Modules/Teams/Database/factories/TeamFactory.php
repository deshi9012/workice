<?php

use Faker\Generator as Faker;

$ar = ['Modules\Projects\Entities\Project', 'Modules\Tasks\Entities\Task'];
$factory->define(
    Modules\Teams\Entities\Assignment::class, function (Faker $faker) use ($ar) {
        return [
        'user_id' => $faker->numberBetween(1, 10),
        'assignable_id' => $faker->numberBetween(1, 10),
        'assignable_type' => array_random($ar),
        ];
    }
);
