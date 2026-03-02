<?php

namespace Kjjd84\Lucid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Kjjd84\Lucid\Console\FactoryCommand;
use Kjjd84\Lucid\Console\MigrateCommand;
use Kjjd84\Lucid\Console\ModelCommand;

class LucidServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FactoryCommand::class,
                MigrateCommand::class,
                ModelCommand::class,
            ]);
        }

        Model::unguard();
    }
}
