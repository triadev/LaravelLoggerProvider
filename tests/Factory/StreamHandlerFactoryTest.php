<?php

/**
 * Class StreamHandlerFactoryTest
 *
 * @author Christopher Lorke <christopher.lorke@gmx.de>
 */
class StreamHandlerFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function it_test_create_a_stream_handler()
    {
        $streamHandlerFactory = new \Triadev\Logger\Factory\StreamHandlerFactory();

        $streamHandler = $streamHandlerFactory->createStreamHandler(
            'stream',
            'php://stdout',
            100
        );

        $this->assertInstanceOf(\Monolog\Handler\StreamHandler::class, $streamHandler);
    }

    /**
     * @test
     */
    public function it_test_create_a_logstash_stream_handler()
    {
        $streamHandlerFactory = new \Triadev\Logger\Factory\StreamHandlerFactory();

        $streamHandler = $streamHandlerFactory->createStreamHandler(
            'logstash',
            '/var/www/logs/log.err',
            100
        );

        $this->assertInstanceOf(\Monolog\Handler\StreamHandler::class, $streamHandler);
    }
}
