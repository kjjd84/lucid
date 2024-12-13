<?php

namespace Kjjd84\Lucid\Database;

use Illuminate\Database\Eloquent\Factories\Factory as IlluminateFactory;
use Illuminate\Support\Str;

class Factory extends IlluminateFactory
{
    public function definition(): array
    {
        $model = $this->newModel();

        return collect(get_class_methods($model))
            ->filter(function ($method) {
                return $method == 'definition' || Str::endsWith($method, 'Definition');
            })
            ->map(function ($method) use ($model) {
                return $model->$method();
            })
            ->collapse()
            ->toArray();
    }
}
