<?php

namespace Arealtime\ExceptionLog\App\Exceptions;

use Arealtime\ExceptionLog\App\Services\ExceptionLogService;
use Throwable;
use Illuminate\Contracts\Debug\ExceptionHandler;

class ExceptionLogExceptionHandler implements ExceptionHandler
{
    public function __construct(
        protected ExceptionHandler $originalHandler
    ) {}

    public function report(Throwable $e): void
    {
        try {
            ExceptionLogService::log($e);
        } catch (Throwable $internalError) {
        }

        $this->originalHandler->report($e);
    }

    public function render($request, Throwable $e)
    {
        return $this->originalHandler->render($request, $e);
    }

    public function renderForConsole($output, Throwable $e)
    {
        return $this->originalHandler->renderForConsole($output, $e);
    }

    public function shouldReport(Throwable $e)
    {
        return $this->originalHandler->shouldReport($e);
    }
}
