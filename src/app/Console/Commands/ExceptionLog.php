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

        if (!$name) {
            $this->help();
        }

        switch ($name) {
            case ExceptionLogEnum::Help->value:
                $this->showHelp();
                break;
            case ExceptionLogEnum::Migrate->value:
                $this->migrate();
                break;
            case ExceptionLogEnum::Config->value:
                $this->config();
                break;
            default:
                $this->help();
        }
    }

    /**
     * Displays the usage guide and available actions for the exception log.
     *
     * @return void
     */
    private function help(): void
    {
        $lines = [];
        $lines[] = "╔───────────────────────────────────────────────────────────────────────────────────────╗";
        $lines[] = "│                                                                                       │";
        $lines[] = "│              \033[4m\033[1;32m📚 Arealtime Exception Log v1.0.0 — Command Usage Guide\033[0m                  │";
        $lines[] = "│                                                                                       │";
        $lines[] = "│  \033[1;37m🛠  Usage: \033[1;36mphp artisan arealtime:expcetion-log {action}\033[0m                               │";
        $lines[] = "│                                                                                       │";
        $lines[] = "│  \033[1;37m📝 Available actions: \033[0m                                                               │";
        $lines[] = "│    \033[1;35m- 🛢️  migrate:\033[0;37m Create tables required for logging exceptions.\033[0m                       │";
        $lines[] = "│    \033[1;35m- ⚙️  config:\033[0;37m Review and verify the current configuration settings.\033[0m                 │";
        $lines[] = "│    \033[1;35m- ❓ help:\033[0;37m Display this help message.\033[0m                                              │";
        $lines[] = "│                                                                                       │";
        $lines[] = "│ \033[0;36m╔═══════════════════════════════════════════════════════════════════════════════════╗\033[0m │";
        $lines[] = "│ \033[0;36m║ \033[1;37m💻 Command \033[0;32m                                         \033[1;37m📝 Description\033[0;36m                ║\033[0m │";
        $lines[] = "│ \033[0;36m╠═══════════════════════════════════════════════════════════════════════════════════╣\033[0m │";
        $lines[] = "│ \033[0;36m║ \033[1;34mphp artisan arealtime:exception-log migrate \033[0m  \033[0;37mRun migration for exception tables.\033[0;36m ║\033[0m │";
        $lines[] = "│ \033[0;36m║ \033[1;34mphp artisan arealtime:exception-log config \033[0m   \033[0;37mReview configurations.\033[0;36m              ║\033[0m │";
        $lines[] = "│ \033[0;36m║ \033[1;34mphp artisan arealtime:exception-log help   \033[0m   \033[0;37mDisplay this help message.\033[0;36m          ║\033[0m │";
        $lines[] = "│ \033[0;36m╚═══════════════════════════════════════════════════════════════════════════════════╝\033[0m │";

        $lines[] = "│                                                                                       │";
        $lines[] = "╚───────────────────────────────────────────────────────────────────────────────────────╝";

        $this->line(implode("\n", $lines));
    }

    /**
     * Displays the usage guide and available actions for the exception log.
     *
     * @return void
     */
    private function showHelp(): void
    {
        $lines[] = "╔──────────────────────────────────────────────────────────────────────────────╗";
        $lines[] = "│                                                                              │";
        $lines[] = "│              \033[4m\033[1;32m🚀 How to Use Arealtime Exception Log Step-by-Step\033[0m              │";
        $lines[] = "│                                                                              │";
        $lines[] = "│  \033[1;37m1-\033[0m \033[1;36mphp artisan arealtime:exception-log migrate\033[0m                              │";
        $lines[] = "│     \033[0;37mRun this command to create the database table for logging exceptions.\033[0m    │";
        $lines[] = "│                                                                              │";
        $lines[] = "│  \033[1;37m2-\033[0m \033[1;36mphp artisan arealtime:exception-log config\033[0m                               │";
        $lines[] = "│     \033[0;37mUse this to check where the User model is defined in the config file.\033[0m    │";
        $lines[] = "│     \033[0;37mIf the User model is not correctly configured, user_id will not be saved.\033[0m│";
        $lines[] = "│                                                                              │";
        $lines[] = "│  \033[1;37m3-\033[0m \033[1;36mphp artisan arealtime:exception-log run-ui\033[0m                               │";
        $lines[] = "│     \033[0;37mFinally, run this command to view the web UI for exception logs.\033[0m         │";
        $lines[] = "│                                                                              │";
        $lines[] = "│                                                                              │";
        $lines[] = "╚──────────────────────────────────────────────────────────────────────────────╝";

        $this->line(implode("\n", $lines));
    }

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
    private function config(): void
    {
        $message = '';
        $userModel = config('arealtime-exception-log.user_model');

        $relativePath = str_replace('App\\', '', $userModel);

        $relativePath = str_replace('\\', DIRECTORY_SEPARATOR, $relativePath);

        $filePath = app_path($relativePath . '.php');

        if (file_exists($filePath)) {
            $message = "✅ \033[1m\033[1;37mExecutor file found at:                                                    │ \n│   \033[3m\033[1;36m{$filePath}\033[0m                           │\n│                                                                               │\n│                             ✅ \033[3m\033[1;30m\033[42mConfiguration is OK.\033[0m                           │ ";
        } else {
            $message = "⚠️  \033[1m\033[1;37mExecutor model file not found at:                                          │ \n│   \033[3m\033[1;36m{$filePath}\033[0m                          │\n│                                                                               │\n│                           ❌ \033[3m\033[1;30m\033[41mConfiguration is not OK.\033[0m                         │ ";
        }

        $lines[] = "╔───────────────────────────────────────────────────────────────────────────────╗";
        $lines[] = "│                                                                               │";
        $lines[] = "│             🔍 \033[4m\033[1;32mChecking Configuration for Arealtime Exception Log\033[0m             │";
        $lines[] = "│                                                                               │";
        $lines[] = "│ $message ";
        $lines[] = "╚───────────────────────────────────────────────────────────────────────────────╝";

        $this->line(implode("\n", $lines));
    }
}
