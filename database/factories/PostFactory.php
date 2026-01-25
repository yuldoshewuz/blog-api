<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(6, 10));
        return [
            'user_id' => User::where('role', 'admin')->first()->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraphs(5, true),
            'image' => 'https://source.unsplash.com/featured/800x600?nature,water,' . rand(1, 1000),
            'status' => 'published',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
