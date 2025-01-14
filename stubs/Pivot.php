<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Kjjd84\Lucid\Database\Blueprint;

class DummyClass extends Pivot
{
    public function schema(Blueprint $table): void
    {
        $table->id();
        $table->integer('first_id')->index();
        $table->integer('second_id')->index();
        $table->timestamp('created_at');
        $table->timestamp('updated_at');
    }

    // public function first()
    // {
    //     return $this->belongsTo(First::class);
    // }

    // public function second()
    // {
    //     return $this->belongsTo(Second::class);
    // }
}
