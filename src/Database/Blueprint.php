<?php

namespace Kjjd84\Lucid\Database;

use Illuminate\Database\Schema\Blueprint as IlluminateBlueprint;
use Illuminate\Database\Schema\ColumnDefinition;

class Blueprint extends IlluminateBlueprint
{
    public function addColumn($type, $name, array $parameters = []): ColumnDefinition
    {
        $columnDefinition = parent::addColumn($type, $name, $parameters);

        if ($name != 'id') {
            $columnDefinition->nullable();
        }

        return $columnDefinition;
    }
}
