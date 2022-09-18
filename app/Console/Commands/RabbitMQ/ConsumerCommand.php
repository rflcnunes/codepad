<?php

namespace App\Console\Commands\RabbitMQ;

use Illuminate\Console\Command;
use App\Repositories\RabbitMQ\ConsumerRepository;

class ConsumerCommand extends Command
{
    private $consumer;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a AMQP consumer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ConsumerRepository $consumer)
    {
        parent::__construct();
        $this->consumer = $consumer;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->consumer->consume('rabbitmq', 'create_test_queue', function ($message) {
            return $message->body;
        });
    }
}
