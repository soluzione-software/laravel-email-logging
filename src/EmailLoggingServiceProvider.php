<?php


namespace SoluzioneSoftware\EmailLogging;


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
        $this->mergeConfigFrom(__DIR__ . '/../config/email_logging.php', 'email_logging');

        $this->registerLogHandler();
    }

    protected function registerLogHandler()
    {
        if (Config::get('email_logging.enabled')){
            Log::extend('email', function () {
                /** @var Swift_Mailer $mailer */
                $mailer = $this->app['mailer']->getSwiftMailer();
                $message = $mailer->createMessage()
                    ->setFrom(
                        Config::get('email_logging.from.address'),
                        Config::get('email_logging.from.name')
                    )
                    ->setTo(Config::get('email_logging.to'))
                    ->setContentType('text/html');

                $level = Logger::getLevels()[strtoupper(Config::get('email_logging.level'))];

                $handler = new SwiftMailerHandler($mailer, $message, $level);
                $handler->setFormatter(new HtmlFormatter());

                $logger = new Logger('email');
                $logger->pushHandler($handler);

                return $logger;
            });
        }
    }
}
