<?php

namespace App\Repositories\RabbitMQ;

use App\Repositories\Interfaces\RabbitMQ\ConsumerRepositoryInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Closure;
use Exception;

class ConsumerRepository implements ConsumerRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function consume($host, $queue, Closure $callback)
    {
        $connection = new AMQPStreamConnection($host, 5672, 'guest', 'guest');

        $channel = $connection->channel();

        $callback = function ($message) {
            echo PHP_EOL . 'Consuming: ' . $message->body . PHP_EOL . PHP_EOL . PHP_EOL . 'Press CTRL+C to exit' . PHP_EOL;
        };

        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
