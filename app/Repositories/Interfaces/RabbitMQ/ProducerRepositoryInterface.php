<?php

namespace App\Repositories\Interfaces\RabbitMQ;

interface ProducerRepositoryInterface
{
    public function publish($host, $exchange, $exchangeType, $queue, $payload, $routingKey);
}
