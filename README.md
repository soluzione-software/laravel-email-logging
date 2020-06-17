# Laravel Email Logging
[![Latest Version](http://img.shields.io/packagist/v/soluzione-software/laravel-email-logging.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/soluzione-software/laravel-email-logging)
[![MIT License](https://img.shields.io/github/license/soluzione-software/laravel-email-logging.svg?label=License&color=blue&style=for-the-badge)](https://github.com/soluzione-software/laravel-email-logging/blob/master/LICENSE.md)

Adds the email driver for logging.

## Installation and usage

``` bash
composer require soluzione-software/laravel-email-logging
```

in `config/logging.php`:
``` php
return [

    //...

    'channels' => [
        'stack' => [
            //...
            'channels' => ['daily', 'email'],
            //...
        ],

        //...

        'email' => [
            'driver' => 'email',
        ],
    ],
];
```

## Customization
`.env` variables:
```dotenv
LOG_EMAIL_ENABLED=true
LOG_EMAIL_LEVEL=warning
LOG_EMAIL_FROM_ADDRESS=info@example.com
LOG_EMAIL_FROM_NAME=Example
LOG_EMAIL_TO=support@example.com
```
