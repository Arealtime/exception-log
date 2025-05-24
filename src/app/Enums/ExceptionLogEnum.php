<?php

namespace Arealtime\ExceptionLog\App\Enums;

enum ExceptionLogEnum: string
{
    case Help = 'help';
    case Migrate = 'migrate';
    case Config = 'config';
    case RunUI = 'run-ui';
}
