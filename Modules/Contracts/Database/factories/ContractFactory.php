<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Contracts\Entities\Contract::class, function (Faker $faker) {
        return [
        'client_id' => $faker->numberBetween(1, 10),
        'contract_title' => $faker->company.' Contract',
        'start_date' => now()->toDateTimeString(),
        'end_date' => now()->addDays(rand(3, 90)),
        'expiry_date' => $faker->numberBetween(1, 14),
        'hourly_rate' => $faker->randomFloat(2, 10, 20),
        'payment_terms' => $faker->numberBetween(1, 14),
        'termination_notice' => $faker->numberBetween(5, 14),
        'late_fee_percent' => 1,
        'description' => $faker->text(800),
        'currency' => 'USD',
        'services' => $faker->sentence(6),
        'cancelation_fee' => $faker->randomFloat(2, 10, 15),
        'license_owner' => array_random(['freelancer', 'client']),
        'client_rights' => $faker->text(200),
        'user_id' => 1
        ];
    }
);
