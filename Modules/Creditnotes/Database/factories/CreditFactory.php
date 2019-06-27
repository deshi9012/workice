<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Creditnotes\Entities\CreditNote::class, function (Faker $faker) {
        return [
        'reference_no' => generateCode('credits'),
        'client_id' => $faker->numberBetween(1, 10),
        'tax' => $faker->randomFloat(2, 0, 10),
        'currency' => 'USD'
        ];
    }
);
