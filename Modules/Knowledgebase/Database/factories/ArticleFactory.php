<?php

use Faker\Generator as Faker;

$factory->define(
    Modules\Knowledgebase\Entities\Knowledgebase::class, function (Faker $faker) {
        return [
        'group' => App\Entities\Category::whereModule('knowledgebase')->inRandomOrder()->first()->id,
        'subject' => $faker->sentence(6),
        'description' => $faker->text(800),
        'user_id' => $faker->numberBetween(1, 5)
        ];
    }
);
