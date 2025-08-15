<?php

namespace Kjjd84\Lucid\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModelCommand extends GeneratorCommand
{
    protected $name = 'lucid:model';

    protected $description = 'Create a new Lucid model';

    protected $type = 'Model';

    public function handle(): void
    {
        if (parent::handle() === false && !$this->option('force')) {
            return;
        }

        if ($this->argument('name') == 'User') {
            $this->replaceUserMigration();
        }

        if (!$this->option('pivot')) {
            $this->createFactory();
        }

        if ($this->option('resource')) {
            $this->createResource();
        }
    }

    protected function replaceUserMigration(): void
    {
        $file = database_path('migrations/0001_01_01_000000_create_users_table.php');

        copy(__DIR__ . '/../../stubs/UserMigration.php', $file);

        $this->components->info(sprintf('Migration [%s] replaced successfully.', $file));
    }

    protected function createFactory(): void
    {
        $this->call('lucid:factory', [
            'name' => $this->argument('name'),
            '--force' => $this->option('force'),
        ]);
    }

    protected function createResource(): void
    {
        $this->call('make:filament-resource', [
            'model' => $this->argument('name'),
            '--embed-schemas' => true,
            '--embed-table' => true,
            '--view' => true,
        ]);
    }

    protected function getStub(): string
    {
        if ($this->argument('name') == 'User') {
            return __DIR__ . '/../../stubs/UserModel.php';
        }

        if ($this->option('pivot')) {
            return __DIR__ . '/../../stubs/Pivot.php';
        }

        return __DIR__ . '/../../stubs/Model.php';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\\Models';
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the model even if it already exists'],
            ['pivot', 'p', InputOption::VALUE_NONE, 'Create a pivot instead of a regular model'],
            ['resource', 'r', InputOption::VALUE_NONE, 'Create a Filament resource for the model'],
        ];
    }
}
