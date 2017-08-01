<?php
namespace Triadev\Logger\Provider;

use Illuminate\Support\ServiceProvider;
use Log;
use Triadev\Logger\Factory\StreamHandlerFactory;
use Monolog\Logger;

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

        $config = config('sc-logger');

        // Handler
        $streamHandlerFactory = new StreamHandlerFactory();
        $handler = $streamHandlerFactory->createStreamHandler(
            $config['log_type'],
            $config['log_stream'],
            $config['log_level']
        );

        // Register
        if (class_exists('Illuminate\Foundation\Application', false)) {
            Log::getMonolog()->pushHandler(
                $handler
            );
        } elseif (class_exists('Laravel\Lumen\Application', false)) {
            $app = $this->app;
            $this->app->configureMonologUsing(function ($monolog) use (
                $app,
                $handler
            ) {
                /** @var Logger $monolog */
                $monolog->pushHandler($handler);
                
                return $monolog;
            });
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
}
