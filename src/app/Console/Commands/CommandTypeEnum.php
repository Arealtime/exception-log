<?php

namespace Arealtime\ExceptionLog\App\Console\Commands;

enum CommandTypeEnum: string
{
    case Help = 'help';
    case Migrate = 'migrate';
    case Config = 'config';
}
