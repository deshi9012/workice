<?php

use Faker\Generator as Faker;

$ar = ['3M.png', 'algolia.png', 'disney-min.jpg', 'docker-logo.png', 'apple.jpg',
'dropbox.svg', 'ebay-logo-min.jpg', 'envato-logo.png', 'google.png', 'ibm-logo.jpg', 'intel.gif',
'macdonalds-min.jpg', 'nike-min.png', 'paypal.png', 'pepsi-min.jpg', 'salesforce.png',
'shell-min.jpg', 'soundcloud.png', 'tux_droid_1.jpg', 'twitter.png', 'visa-min.png'
];
$factory->define(
    Modules\Clients\Entities\Client::class, function (Faker $faker) use ($ar) {
        return [
        'code' => generateCode('clients'),
        'name' => $faker->company,
        'email' => $faker->safeEmail,
        'address1' => $faker->address,
        'website' => 'https://'.$faker->domainName,
        'city' => $faker->city,
        'country' => $faker->country,
        'notes' => $faker->paragraph,
        'owner' => $faker->numberBetween(1, 5),
        'primary_contact' => $faker->numberBetween(1, 5),
        'logo' => array_random($ar),
        ];
    }
);
