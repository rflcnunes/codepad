<?php

namespace App\Console\Commands\RabbitMQ;

use Illuminate\Console\Command;
use App\Repositories\RabbitMQ\ProducerRepository;

class ProducerCommand extends Command
{
    private $producer;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:producer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a AMQP producer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProducerRepository $producer)
    {
        parent::__construct();
        $this->producer = $producer;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->producer->publish('rabbitmq', 'test_command', 'direct', 'create_test_queue', 'Create Test', 'create_test');
    }
}
