<?php

return [

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => '\\OAuth\\Common\\Storage\\Session',

    /**
     * Consumers
     */
    'consumers' => [

        'Facebook' => [
            'client_id'     => env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'scope'         => [],
        ],
        'Google' => [
            'client_id'     => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'scope'         => ['userinfo_email', 'userinfo_profile', 'https://www.googleapis.com/auth/calendar', 'https://mail.google.com/', 'https://www.google.com/m8/feeds/'],
        ],
        'Twitter' => [
            'client_id'     => env('TWITTER_CLIENT_ID'),
            'client_secret' => env('TWITTER_CLIENT_SECRET'),
            // No scope - oauth1 doesn't need scope
        ],
        'Linkedin' => [
            'client_id'     => env('LINKEDIN_CLIENT_ID'),
            'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
            'scope'         => ['r_basicprofile', 'r_network', 'w_messages']

        ],
        'Harvest' => [
            'client_id'     => env('HARVEST_CLIENT_ID'),
            'client_secret' => env('HARVEST_CLIENT_SECRET'),
            
        ],
        'Box' => [
            'client_id'     => env('BOX_CLIENT_ID'),
            'client_secret' => env('BOX_CLIENT_SECRET'),
            
        ],
        'Dropbox' => [
            'client_id'     => env('DROPBOX_CLIENT_ID'),
            'client_secret' => env('DROPBOX_CLIENT_SECRET'),
            
        ],
        

    ]

];
