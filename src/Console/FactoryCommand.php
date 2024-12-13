<?php

namespace Kjjd84\Lucid\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class FactoryCommand extends GeneratorCommand
{
    protected $name = 'lucid:factory';

    protected $description = 'Create a new Lucid factory';

    protected $type = 'Factory';

    protected function getStub(): string
    {
        if ($this->argument('name') == 'User') {
            return __DIR__ . '/../../stubs/UserFactory.php';
        }

        return __DIR__ . '/../../stubs/Factory.php';
    }

    protected function getPath($name): string
    {
        $name = (string) Str::of($name)->replaceFirst($this->rootNamespace(), '')->finish('Factory');

        return $this->laravel->databasePath() . '/factories/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the factory even if it already exists'],
        ];
    }
}
