<?php

namespace Arealtime\ExceptionLog\App\Providers;

use Arealtime\ExceptionLog\App\Console\Commands\ExceptionLog;
use Arealtime\ExceptionLog\App\Exceptions\ExceptionLogExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class ExceptionLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([ExceptionLog::class]);

        $this->app->extend(ExceptionHandler::class, function ($handler) {
            return new ExceptionLogExceptionHandler($handler);
        });
    }

    public function boot()
    {

    }
}
