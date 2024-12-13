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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'stripe' => [
        'key' => env('pk_test_51QV9aiP3R10z9hqG1izg9O8LpXfCdEEdkzX9SzLFEvVqCLa9fz9U6dDDPjznlXekJU4dgi1yvuERZBrLHDP9yj6Q00kh1Fpi1W'),
        'secret' => env('sk_test_51QV9aiP3R10z9hqGG2BgTffJo56vwGSVcb33IN1qQT4O9ujzAE2aEm3eyP398OLBLS2dWPk9OenEdTbwxQE1W81H001eIv2L1O'),
    ],

];
