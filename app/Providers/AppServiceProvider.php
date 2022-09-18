<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\RabbitMQ\ProducerRepositoryInterface;
use App\Repositories\RabbitMQ\ProducerRepository;
use App\Repositories\Interfaces\RabbitMQ\ConsumerRepositoryInterface;
use App\Repositories\RabbitMQ\ConsumerRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProducerRepositoryInterface::class,
            ProducerRepository::class
        );

        $this->app->bind(
            ConsumerRepositoryInterface::class,
            ConsumerRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
