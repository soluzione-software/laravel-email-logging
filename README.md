# Laravel Email Logging
[![Latest Version](http://img.shields.io/packagist/v/soluzione-software/laravel-email-logging.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/soluzione-software/laravel-email-logging)
[![MIT License](https://img.shields.io/github/license/soluzione-software/laravel-email-logging.svg?label=License&color=blue&style=for-the-badge)](https://github.com/soluzione-software/laravel-email-logging/blob/master/LICENSE.md)

Adds the email driver for logging.

## Installation and usage

```bash
composer require soluzione-software/laravel-email-logging
```

create channel config in `config/logging.php`:
```php
return [
    //...

    'channels' => [
        //...

        'email' => [
            'driver' => 'email',
        ],
    ],
];
```
Then you can do like follows:
 ```php
 Illuminate\Support\Facades\Log::channel('email')->error('...');
 ```

## Configuration

See [Laravel documentation](https://laravel.com/docs/logging#configuration) for configuring channels. 

In order to disable email sending, set `null` value for `to` option, like follows:
```php
return [

    //...

    'channels' => [
        //...

        'email' => [
            //...
            'to' => null,
        ],
    ],
];
```

### Available Configuration Options

Name | Default
------------- | -------------
`level` | `error`
`to` | `null`
`from.address` | see config `mail.from.address`
`from.name` | see config `mail.from.name`
