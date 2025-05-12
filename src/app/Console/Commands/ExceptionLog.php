<?php

namespace Arealtime\ExceptionLog\App\Console\Commands;

use Arealtime\ExceptionLog\App\Enums\ExceptionLogEnum;
use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ExceptionLog extends Command
{
    protected $signature = 'arealtime:exception-log {name}';
    protected $description = 'Command for ExceptionLog module';

    public function handle()
    {
        $name = $this->argument('name');

        switch ($name) {
            case ExceptionLogEnum::Help->value:
                $this->help();
                break;
            case ExceptionLogEnum::Migrate->value:
                $this->migrate();
                break;
            case ExceptionLogEnum::Config->value:
                $this->config();
                break;
            default:
                null;
        }
    }

    private function help() {}
    
    private function migrate()
    {
        $path = 'vendor/arealtime/exception-log/src/database/migrations';

        if (!is_dir($path)) {
            $this->error("Migration path not found: $path");
            return;
        }

        $process = new Process(['php', 'artisan', 'migrate', '--path=' . $path]);
        $process->setTty(Process::isTtySupported());

        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info('Exception Logger migrations executed.');
    }
    private function config() {}
}
