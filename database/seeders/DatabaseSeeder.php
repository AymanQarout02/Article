<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin1',
            'email' => 'a1@example.com',
            'role' => 'admin',
            'password' => bcrypt('a12345678')
        ]);
        User::factory()->create([
            'name' => 'Admin2',
            'email' => 'a2@example.com',
            'role' => 'admin',
            'password' => bcrypt('a12345678')
        ]);

        User::factory(4)->publisher()->create();
        User::factory(10)->viewer()->create();


        $categoryNames = [
            'Technology', 'Science', 'Health', 'Travel', 'Food',
            'Education', 'Sports', 'Business', 'Entertainment', 'Lifestyle'
        ];
        foreach ($categoryNames as $name) {
            Category::factory()->create([
                'name' => $name,
                'created_by' => User::whereIn('role', ['publisher', 'admin'])->inRandomOrder()->first()->id
            ]);
        }

        Article::factory(50)->create();

    }
}
