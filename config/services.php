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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
        'active' => env('STRIPE_ACTIVE', false),
    ],

    'no-captcha' => [
        'active' => env('REGISTRATION_CAPTCHA_STATUS', false),
    ],

    'paypal' => [
        'active' => env('PAYPAL_ACTIVE', false),
    ],

    'razorpay' => [
        'active' => env('RAZORPAY_ACTIVE', false),
        'key' => env('RAZORPAY_KEY'),
        'secret' => env('RAZORPAY_SECRET'),
    ],

    'payu' => [
        'active' => env('PAYU_ACTIVE', false),
        'mode' => env('PAYU_MODE', 'sandbox'),
        'key' => env('PAYU_KEY'),
        'salt' => env('PAYU_SALT'),
        'merchant_id' => env('PAYU_MERCHANT_ID', 5007461),
    ],

    /*
     * Socialite Credentials
     * Redirect URL's need to be the same as specified on each network you set up this application on
     * as well as conform to the route:
     * http://localhost/public/login/SERVICE
     * Where service can facebook, google
     * Docs: https://github.com/laravel/socialite
     * Make sure 'scopes' and 'with' are arrays, if their are none, use empty arrays []
     */

    'facebook' => [
        'active' => env('FACEBOOK_ACTIVE', false),
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
        'scopes' => [],
        'with' => [],
        'fields' => [],
    ],

    'google' => [
        'active' => env('GOOGLE_ACTIVE', false),
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),

        'tag_manager_code' => env('GOOGLE_TAG_MANAGER_CODE'),

        /*
         * Only allows google to grab email address
         * Default scopes array also has: 'https://www.googleapis.com/auth/plus.login'
         * https://medium.com/@njovin/fixing-laravel-socialite-s-google-permissions-2b0ef8c18205
         */
        'scopes' => [
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/plus.login',
        ],

        'with' => [],
    ],
];
