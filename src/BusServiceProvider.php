<?php
namespace Mineko\Bus;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Mineko\Bus\NamespaceDispatcher;

class BusServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->extend(Dispatcher::class, function () {
            $app = $this->app;
            return new NamespaceDispatcher($app, function ($connection = null) use ($app) {
                return $app[QueueFactoryContract::class]->connection($connection);
            });
        });
    }
}
