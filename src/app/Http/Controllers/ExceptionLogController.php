<?php

namespace Arealtime\ExceptionLog\App\Http\Controllers;

use Illuminate\Routing\Controller;

class ExceptionLogController extends Controller
{
    public function index()
    {
        return view('exception-log::index');
    }
}
