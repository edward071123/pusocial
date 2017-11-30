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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '111033766256000',
        'client_secret' => '1a6288065c5d9bb0b5448aacfdfb0b25',
        'redirect' => 'https://edwardspeedforce.com/pusocial/auth/facebook/callback',
    ],
    // 'google' => [
    //     'client_id' => '499673680979-shlq2sruoi2ml80us5hfr0iprq6bsbsh.apps.googleusercontent.com',
    //     'client_secret' => '1gJMcm7d3YBSGuY7LpuNgxgz',
    //     'redirect' => 'https://edwardspeedforce.com/pusocial/auth/google/callback',
    // ],
];
