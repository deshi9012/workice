<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Deals\Entities\Deal::class, function (Faker $faker) {
        return [
        'title' => $faker->company. ' Deal',
        'stage_id' => App\Entities\Category::whereModule('deals')->inRandomOrder()->first()->id,
        'currency' => 'USD',
        'deal_value' => $faker->randomFloat(2, 10, 1000),
        'contact_person' => $faker->numberBetween(1, 5),
        'organization' => $faker->numberBetween(1, 10),
        'due_date' => now()->addDays(rand(3, 60)),
        'source' => App\Entities\Category::whereModule('source')->inRandomOrder()->first()->id,
        'pipeline' => App\Entities\Category::whereModule('pipeline')->inRandomOrder()->first()->id,
        'user_id' => $faker->numberBetween(1, 5)
        ];
    }
);
