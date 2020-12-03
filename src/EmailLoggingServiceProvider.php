<?php

namespace SoluzioneSoftware\EmailLogging;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\SwiftMailerHandler;
use Monolog\Logger;
use Swift_Mailer;

class EmailLoggingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerLogHandler();
    }

    protected function registerLogHandler()
    {
        Log::extend('email', function ($app, array $config) {
            $fromAddress = Arr::get($config, 'from.address', Config::get('mail.from.address'));
            $fromName = Arr::get($config, 'from.name', Config::get('mail.from.name'));
            $to = Arr::get($config, 'to');
            $level = Arr::get($config, 'level', Logger::ERROR);

            $logger = new Logger('email');

            if (!empty($to)) {
                /** @var Swift_Mailer $mailer */
                $mailer = $this->app['mailer']->getSwiftMailer();
                $message = $mailer->createMessage()
                    ->setFrom($fromAddress, $fromName)
                    ->setTo($to)
                    ->setContentType('text/html');

                $handler = new SwiftMailerHandler($mailer, $message, $level);
                $handler->setFormatter(new HtmlFormatter());
                $logger->pushHandler($handler);
            }

            return $logger;
        });
    }
}
