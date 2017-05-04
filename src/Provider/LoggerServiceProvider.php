<?php
namespace Triadev\Logger\Provider;

use Illuminate\Support\ServiceProvider;
use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Log;
use Config;

/**
 * Class LoggerServiceProvider
 *
 * @author Christopher Lorke <lorke@traum-ferienwohnungen.de>
 * @package Triadev\Logger\Provider
 */
class LoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__ . '/../Config/config.php');

        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('sc-logger.php'),
        ], 'config');

        $this->mergeConfigFrom($source, 'sc-logger');

        $config = Config::get('sc-logger');

        // Handler
        $handler = $this->createStreamHandler(
            strtolower($config['log_type']),
            $config['log_stream'],
            $config['log_level']
        );

        // Register
        if (class_exists('Illuminate\Foundation\Application', false)) {
            Log::getMonolog()->pushHandler(
                $handler
            );
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Create stream handler
     *
     * @param string $type
     * @param string $stream
     * @param string $level
     * @return StreamHandler
     */
    private function createStreamHandler(string $type, string $stream, string $level) : StreamHandler
    {
        switch ($type) {
            case 'stream':
                $handler = new StreamHandler($stream, $level);
                break;
            case 'logstash':
                $handler = new StreamHandler($stream, $level);
                $handler->setFormatter(
                    new LogstashFormatter('Logger')
                );
                break;
            default:
                $handler = new StreamHandler('php://stdout', Logger::DEBUG);
        }

        return $handler;
    }
}
