<?php

namespace Arealtime\ExceptionLog\App\Services;

use Arealtime\ExceptionLog\App\Models\ExceptionLog;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ExceptionLogService
{
    public static function log(Throwable $throwable): void
    {
        $request = request();
        ExceptionLog::forceCreate([
            'type'        => get_class($throwable),
            'message'     => $throwable->getMessage(),
            'trace'       => $throwable->getTraceAsString(),
            'file'        => $throwable->getFile(),
            'line'        => $throwable->getLine(),
            'code'        => $throwable->getCode(),
            'url'         => $request->fullUrl(),
            'method'      => $request->method(),
            'ip'          => $request->ip(),
            'user_agent'  => $request->header('User-Agent'),
            'user_id'     => Auth::id(),
            'headers'     => json_encode($request->header()),
            'input'       => json_encode($request->except(['password', 'password_confirmation'])),
        ]);
    }
}
