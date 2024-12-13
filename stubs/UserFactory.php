<?php

namespace Database\Factories;

use Kjjd84\Lucid\Database\Factory;

class UserFactory extends Factory
{
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
