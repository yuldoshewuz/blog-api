<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('11111111'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
