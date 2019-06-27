<?php

use Faker\Generator as Faker;

// $ar = ['Modules\Invoices\Entities\Invoice', 'Modules\Estimates\Entities\Estimate', 'Modules\Creditnotes\Entities\CreditNote'];
$factory->define(
    Modules\Items\Entities\Item::class,
    function (Faker $faker) {
        return [
            'tax_rate'    => $faker->randomFloat(2, 1, 20),
            'name'        => $faker->sentence(3),
            'description' => $faker->text(25),
            'quantity'    => $faker->numberBetween(1, 10),
            'unit_cost'   => $faker->randomFloat(2, 50, 200),
        ];
    }
);
