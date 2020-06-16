<?php

return [
    'enabled' => env('LOG_EMAIL_ENABLED', true),

    /*
     * debug, info, notice, warning, error, critical, alert, emergency
     */
    'level' => env('LOG_EMAIL_LEVEL', 'warning'),

    'from' => [
        'address' => env('LOG_EMAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS')),
        'name' => env('LOG_EMAIL_FROM_NAME', env('MAIL_FROM_NAME')),
    ],

    'to' => env('LOG_EMAIL_TO', env('MAIL_FROM_ADDRESS')),
];
