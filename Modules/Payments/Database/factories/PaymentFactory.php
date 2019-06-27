<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Payments\Entities\Payment::class,
    function (Faker $faker) {
        return [
            'invoice_id'       => $faker->numberBetween(1, 10),
            'client_id'        => $faker->numberBetween(1, 10),
            'payment_method'   => App\Entities\AcceptPayment::inRandomOrder()->first()->method_id,
            'currency'         => 'USD',
            'payment_date'     => now()->subDays(rand(1, 30)),
            'amount'           => $faker->randomFloat(2, 600, 1000),
            'amount_formatted' => '',
        ];
    }
);
