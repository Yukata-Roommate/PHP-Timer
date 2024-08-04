<?php

namespace YukataRm\Laravel\Timer\Provider;

use Illuminate\Support\ServiceProvider;

use YukataRm\Laravel\Timer\Facade\Manager;
use YukataRm\Laravel\Timer\Facade\Timer;

/**
 * Facade Service Provider
 * 
 * @package YukataRm\Laravel\Timer\Provider
 */
class FacadeServiceProvider extends ServiceProvider
{
    /**
     * register Facade
     * 
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Timer::class, function () {
            return new Manager();
        });
    }
}
