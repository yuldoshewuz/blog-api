<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->word();
        return [
            'name' => ucfirst($name),
            'slug' => str($name)->slug(),
        ];
    }
}
