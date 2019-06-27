<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Tickets\Entities\Ticket::class,
    function (Faker $faker) {
        return [
        'code' => generateCode('tickets'),
        'subject' => $faker->firstNameMale.' Ticket',
        'body' => $faker->text(800),
        'department' => App\Entities\Department::inRandomOrder()->first()->deptid,
        'user_id' => $faker->numberBetween(1, 20),
        'priority' => App\Entities\Priority::inRandomOrder()->first()->id,
        'status' => App\Entities\Status::whereStatus('open')->first()->id,
        'assignee' => 1
        ];
    }
);
