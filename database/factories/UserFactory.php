<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Modules\Users\Entities\User::class, function (Faker $faker) {
    static $password;

    return [
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->name,
        // 'password' => $password ?: $password = bcrypt('secret'),
        'password' => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
        'email_verified_at' => now(),
    ];
});
