<?php

use Arealtime\ExceptionLog\App\Http\Controllers\ExceptionLogController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('exception-logs')->group(function () {
    Route::get('', [ExceptionLogController::class, 'index']);
});
