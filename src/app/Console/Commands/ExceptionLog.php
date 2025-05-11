<?php

namespace Arealtime\ExceptionLog\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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
            case CommandTypeEnum::Help->value:
                $this->help();
                break;
            case CommandTypeEnum::Migrate->value:
                $this->migrate();
                break;
            case CommandTypeEnum::Config->value:
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
