<?php
namespace Triadev\Logger\Provider;

use Illuminate\Support\ServiceProvider;
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
