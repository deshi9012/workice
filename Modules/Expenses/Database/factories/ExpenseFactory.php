<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Expenses\Entities\Expense::class,
    function (Faker $faker) {
        return [
            'code'         => generateCode('expenses'),
            'client_id'    => $faker->numberBetween(1, 10),
            'project_id'   => $faker->numberBetween(1, 10),
            'tax'          => $faker->randomFloat(2, 0, 10),
            'amount'       => $faker->randomFloat(2, 100, 1000),
            'category'     => App\Entities\Category::whereModule('expenses')->inRandomOrder()->first()->id,
            'is_visible'   => $faker->numberBetween(0, 1),
            'vendor'       => $faker->company,
            'expense_date' => now()->subDays(rand(1, 30)),
            'currency'     => 'USD',
            'user_id'      => $faker->numberBetween(1, 5),
        ];
    }
);
