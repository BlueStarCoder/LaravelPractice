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

    'github' => [
        'client_id' => 'our client id',
        'client_secret' => 'our client secret',
        'redirect' => 'redirection url'
    ],
    
    'google' => [
        'client_id' => 'our client id',
        'client_secret' => 'our client secret',
        'redirect' => 'redirection url'
    ],

    'facebook' => [
        'client_id' => '143116486310948',
        'client_secret' => '0f841043fb87162f0b482576fd7fc73d',
        'redirect' => 'http://laravel-fb.dev:8000/callback'
    ],
];
