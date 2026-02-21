<?php

namespace Kjjd84\Lucid\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class FilamentCommand extends Command
{
    protected $signature = 'lucid:filament';

    protected $description = 'Install filament in a fresh Laravel app';

    public function handle(): void
    {
        $this->components->task('Installing Filament via Composer', function () {
            Process::run('composer require filament/filament:"^5.0"');

            Process::run('php artisan filament:upgrade');
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

        $this->components->task('Creating user classes & migrating', function () {
            Process::run('php artisan lucid:model User -r --force');

            Process::run('php artisan lucid:migrate -fs');
        });
    }
}
