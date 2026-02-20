<?php

namespace Kjjd84\Lucid\Console;

use Illuminate\Console\Command;

class FilamentCommand extends Command
{
    protected $signature = 'lucid:filament';

    protected $description = 'Install filament and the user resource';

    public function handle(): void
    {
        exec('composer require filament/filament:"^5.0"');

        require_once base_path('vendor/autoload.php');

        $this->copyStubs([
            'app/Providers/AdminPanelProvider.php',
            'bootstrap/providers.php',
            'config/filament.php',
            'routes/web.php',
        ]);

        $this->call(ModelCommand::class, [
            'name' => 'User',
            '--resource' => true,
            '--force' => true,
        ]);
    }

    public function copyStubs($filenames)
    {
        foreach ($filenames as $filename) {
            $this->components->task(
                "Copying $filename stub",
                function () use ($filename) {
                    file_put_contents(
                        base_path($filename),
                        file_get_contents(__DIR__ . '/../../stubs/filament/' . basename($filename)),
                    );
                }
            );
        }
    }
}
