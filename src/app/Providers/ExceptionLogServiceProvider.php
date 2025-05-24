<?php

namespace Arealtime\ExceptionLog\App\Providers;

use Arealtime\ExceptionLog\App\Console\Commands\ExceptionLog;
use Arealtime\ExceptionLog\App\Exceptions\ExceptionLogExceptionHandler;
use Arealtime\ExceptionLog\App\Http\Livewire\ExceptionLogComopnent;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ExceptionLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([ExceptionLog::class]);

        $this->app->extend(ExceptionHandler::class, function ($handler) {
            return new ExceptionLogExceptionHandler($handler);
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/arealtime-exception-log.php',
            'arealtime-exception-log'
        );
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'exception-log');

        $this->publishes([
            __DIR__ . '/../../config/arealtime-exception-log.php' => config_path('arealtime-exception-log.php'),
        ], 'arealtime-exception-log-config');

        Livewire::component('exception-log.index', ExceptionLogComopnent::class);

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }
}
