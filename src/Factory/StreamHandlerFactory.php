<?php
namespace Triadev\Logger\Factory;

use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class StreamHandlerFactory
 *
 * @author Christopher Lorke <lorke@traum-ferienwohnungen.de>
 * @package Triadev\Logger\Provider
 */
class StreamHandlerFactory
{
    /**
     * Create stream handler
     *
     * @param string $type
     * @param string $stream
     * @param string $level
     * @return StreamHandler
     */
    public function createStreamHandler(
        string $type = 'stream',
        string $stream = 'php://stdout',
        string $level = Logger::ERROR
    ) : StreamHandler {
        $type = strtolower($type);

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
                $handler = new StreamHandler('php://stdout', Logger::ERROR);
        }

        return $handler;
    }
}
