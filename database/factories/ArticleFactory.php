<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->realText(20),
            'body' => fake()->paragraphs(rand(3, 5), true),
            'created_by' => User::whereIn('role', ['publisher', 'admin'])->inRandomOrder()->first()->id
                ?? User::factory()->publisher()->create()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Article $article) {

            $image = Image::factory()->create([
                'created_by' => $article->created_by ?? User::inRandomOrder()->first()->id
            ]);

            $article->update(['image_id' => $image->id]);


            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $article->categories()->attach($categories);
        });
    }
}
