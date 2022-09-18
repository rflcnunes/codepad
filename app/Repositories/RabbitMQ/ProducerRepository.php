<?php

namespace App\Repositories\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\Repositories\Interfaces\RabbitMQ\ProducerRepositoryInterface;

class ProducerRepository implements ProducerRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function publish($host, $exchange, $exchangeType, $queue, $payload, $routingKey)
    {
        $connection = new AMQPStreamConnection($host, 5672, 'guest', 'guest');

        $channel = $connection->channel();

        $channel->exchange_declare($exchange, $exchangeType);

        $channel->queue_declare($queue);

        $channel->queue_bind($queue, $exchange, $routingKey);

        $message = new AMQPMessage($payload);

        $channel->basic_publish($message, $exchange, $routingKey);

        $channel->close();
        $connection->close();
    }
}
