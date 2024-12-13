<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kjjd84\Lucid\Database\Blueprint;

class DummyClass extends Model
{
    use HasFactory;

    public function schema(Blueprint $table): void
    {
        $table->id();
        $table->string('name');
        $table->timestamp('created_at');
        $table->timestamp('updated_at');
    }

    public function definition(): array
    {
        return [
            // 'name' => fake()->name(),
        ];
    }
}
