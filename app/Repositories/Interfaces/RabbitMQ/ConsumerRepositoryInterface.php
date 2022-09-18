<?php

namespace App\Repositories\Interfaces\RabbitMQ;

use Closure;

interface ConsumerRepositoryInterface
{
    public function consume($host, $queue, Closure $callback);
}
