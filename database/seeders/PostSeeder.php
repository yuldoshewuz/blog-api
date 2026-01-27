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
            ['title' => 'The Future of Quantum Computing in 2026', 'category_id' => 1, 'body' => 'Quantum computing is no longer a dream...'],
            ['title' => 'How Artificial Intelligence is Reshaping Art', 'category_id' => 1, 'body' => 'Generative AI is not just for coding...'],
            ['title' => 'Web3 and the Decentralized Internet', 'category_id' => 1, 'body' => 'The evolution of the internet continues with blockchain...'],
            ['title' => 'Next-Gen Robotics in Manufacturing', 'category_id' => 1, 'body' => 'Robots are becoming more autonomous and precise...'],
            ['title' => 'Global Market Trends: What Investors Should Know', 'category_id' => 2, 'body' => 'With the global economy shifting towards green energy...'],
            ['title' => 'Cryptocurrency Regulations in 2026', 'category_id' => 2, 'body' => 'Governments are finally setting clear rules for crypto...'],
            ['title' => 'The Rise of Remote Work Economics', 'category_id' => 2, 'body' => 'How cities are changing because of the remote work boom...'],
            ['title' => 'The Ultimate Guide to Mindful Meditation', 'category_id' => 3, 'body' => 'In a fast-paced world, mental health is paramount...'],
            ['title' => 'Nutrition Myths Debunked', 'category_id' => 3, 'body' => 'Science-based look at what you should really eat...'],
            ['title' => 'Biohacking for Longevity', 'category_id' => 3, 'body' => 'Small changes to your lifestyle that can extend your life...'],
            ['title' => 'Top 10 Travel Destinations for Solo Travelers', 'category_id' => 4, 'body' => 'Traveling alone can be the most rewarding experience...'],
            ['title' => 'Sustainable Living: A Practical Guide', 'category_id' => 4, 'body' => 'How to reduce your carbon footprint without stress...'],
            ['title' => 'Minimalist Architecture in Modern Cities', 'category_id' => 4, 'body' => 'Less is more when it comes to urban design...'],
            ['title' => 'The Art of Slow Coffee', 'category_id' => 4, 'body' => 'Why taking your time with morning rituals matters...'],
            ['title' => 'Space Tourism: Is it Affordable Yet?', 'category_id' => 1, 'body' => 'The race to the moon is now a commercial venture...'],
            ['title' => 'Cybersecurity in the Age of AI', 'category_id' => 1, 'body' => 'Protecting data is getting harder as hackers use AI...'],
            ['title' => 'The Future of Electric Vehicles', 'category_id' => 2, 'body' => 'Solid-state batteries are about to change everything...'],
        ];

        foreach ($articles as $article) {
            $category = Category::find($article['category_id'])
                ?? Category::inRandomOrder()->first();

            Post::create([
                'user_id' => $admin->id,
                'category_id' => $category->id,
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'body' => $article['body'] . "\n\n" . str_repeat("This is a professional deep-dive into the topic. " . $article['title'] . " is shaping the future of our industry. ", 15),
                'image' => 'https://picsum.photos/seed/' . Str::random(10) . '/800/600',
                'status' => 'published',
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
