<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->info('Admin user not found. Creating a temporary admin.');
            $admin = User::factory()->create(['role' => 'admin']);
        }

        $articles = [
            [
                'title' => 'The Future of Quantum Computing in 2026',
                'category' => 'Technology & Innovation',
                'body' => 'Quantum computing is no longer a dream. This year, we see significant shifts in how data is processed...',
            ],
            [
                'title' => 'Global Market Trends: What Investors Should Know',
                'category' => 'Business & Finance',
                'body' => 'With the global economy shifting towards green energy, financial markets are reacting in unexpected ways...',
            ],
            [
                'title' => 'The Ultimate Guide to Mindful Meditation',
                'category' => 'Health & Wellness',
                'body' => 'In a fast-paced world, mental health is paramount. Meditation has proven to be the most effective tool...',
            ],
            [
                'title' => 'Top 10 Travel Destinations for Solo Travelers',
                'category' => 'Lifestyle & Travel',
                'body' => 'Traveling alone can be the most rewarding experience of your life. Here are the safest and most beautiful spots...',
            ],
            [
                'title' => 'How Artificial Intelligence is Reshaping Art',
                'category' => 'Technology & Innovation',
                'body' => 'Generative AI is not just for coding; it is creating a new era of digital masterpieces...',
            ]
        ];

        foreach ($articles as $article) {
            $category = Category::where('name', $article['category'])->first()
                ?? Category::inRandomOrder()->first();

            if (!$category) {
                $category = Category::create(['name' => $article['category'], 'slug' => Str::slug($article['category'])]);
            }

            Post::create([
                'user_id' => $admin->id,
                'category_id' => $category->id,
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'body' => $article['body'] . "\n\n" . str_repeat("Lorem ipsum dolor sit amet, consectetur adipiscing elit. ", 10),
                'image' => 'no-image.png',
                'status' => 'published',
            ]);
        }
    }
}
