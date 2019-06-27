<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
     */

    'mailgun'      => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses'          => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost'    => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'nexmo'        => [
        'key'      => env('NEXMO_KEY'),
        'secret'   => env('NEXMO_SECRET'),
        'sms_from' => env('NEXMO_FROM', '15556666666'),
        'active'   => env('NEXMO_ACTIVE', false),
    ],
    'twitter'      => [
        'client_id'     => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect'      => '/callback/twitter',
    ],
    'github'       => [
        'client_id'     => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect'      => '/callback/github',
    ],
    'facebook'     => [
        'client_id'     => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect'      => '/callback/facebook',
    ],
    'google'       => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => '/callback/google',
    ],
    'gitlab'       => [
        'client_id'     => env('GITLAB_CLIENT_ID'),
        'client_secret' => env('GITLAB_CLIENT_SECRET'),
        'redirect'      => '/callback/gitlab',
    ],
    'linkedin'     => [
        'client_id'     => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect'      => '/callback/linkedin',
    ],
    'stripe'       => [
        'model'   => \Modules\Clients\Entities\Client::class,
        'key'     => env('STRIPE_KEY'),
        'secret'  => env('STRIPE_SECRET'),
        'webhook' => [
            'secret'    => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    'razorpay'     => [
        'keyId'     => env('RAZORPAY_KEY', 'test'),
        'secretKey' => env('RAZORPAY_SECRET', 'secret'),
    ],
    '2checkout'    => [
        'sellerId'       => env('2CHECKOUT_SELLER_ID'),
        'publishableKey' => env('2CHECKOUT_PUBLISHABLE_KEY'),
        'privateKey'     => env('2CHECKOUT_PRIVATE_KEY'),
    ],
    'braintree'    => [
        'merchantId' => env('BRAINTREE_MERCHANT_ID', ''),
        'publicKey'  => env('BRAINTREE_PUBLIC_KEY', ''),
        'privateKey' => env('BRAINTREE_PRIVATE_KEY', ''),
    ],
    'wepay'        => [
        'accountId'   => env('WEPAY_ACCOUNT_ID', ''),
        'clientId'    => env('WEPAY_CLIENT_ID', ''),
        'secretId'    => env('WEPAY_SECRET_ID', ''),
        'accessToken' => env('WEPAY_ACCESS_TOKEN', ''),
    ],
    'paytm-wallet' => [
        'env'              => env('PAYTM_ENV', 'live'), // values : (local | production)
        'merchant_id'      => env('PAYTM_MERCHANT_ID', ''),
        'merchant_key'     => env('PAYTM_MERCHANT_KEY', ''),
        'merchant_website' => env('PAYTM_WEBSITE', ''),
        'channel'          => env('PAYTM_CHANNEL', ''),
        'industry_type'    => env('PAYTM_INDUSTRY_TYPE', ''),
    ],

];
