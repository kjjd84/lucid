<?php

namespace Kjjd84\Lucid\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class FilamentCommand extends Command
{
    protected $signature = 'lucid:filament';

    protected $description = 'Install filament and the user resource';

    public function handle(): void
    {
        $this->components->task('Requiring Filament via composer', function () {
            Process::run('composer require filament/filament:"^5.0"');
        });

        $paths = [
            'app/Providers/AdminPanelProvider.php',
            'bootstrap/providers.php',
            'config/filament.php',
            'routes/web.php',
        ];

        foreach ($paths as $path) {
            $this->components->task("Copying $path stub", function () use ($path) {
                file_put_contents(
                    base_path($path),
                    file_get_contents(__DIR__ . '/../../stubs/filament/' . basename($path)),
                );
            });
        }

        $this->components->task('Creating user model & resource', function () {
            Process::run('php artisan lucid:model User -r --force');
        });
    }
}
