<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Invoices\Entities\Invoice::class,
    function (Faker $faker) {
        return [
        'reference_no' => generateCode('invoices'),
        'title' => $faker->name.' Website Project',
        'client_id' => $faker->numberBetween(1, 20),
        'tax' => $faker->randomFloat(2, 0, 10),
        'discount' => $faker->randomFloat(2, 0, 10),
        'is_visible' => $faker->numberBetween(0, 1),
        'due_date' => now()->addDays(rand(3, 90)),
        'currency' => 'USD',
        'notes' => $faker->text(300),
        'gateways' => ['paypal' => 'active', 'bank' => 'active']
        ];
    }
);
