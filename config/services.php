<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'paypal'=>[
        'username' => 'sb-c8boq1315343_api1.business.example.com',
        'password'=> 'HP3KQVTDWZPWSWTT',
        'signature'=>'AbMQm7MSbjoSHgn17rofCTdTKLOPAcq8Wdo3wEc1rBESFV86XcCaFftF',
        'sandbox'=>true,
    ],

    'stripe' =>[
        'secret_key'=> 'sk_test_51KOOiqBRfPI8vyVfgkBv6JOsUeLh5KJee8cXLWJ8klXpdhBD1aUqEQw53OJ0OAPQIl7bRjSo3TWTt2cGCwxmIwQB00OfcAmM2W',
    ],

];
