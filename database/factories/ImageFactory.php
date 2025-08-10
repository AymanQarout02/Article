<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fileName = time() . '_' . fake()->unique()->numberBetween(1000, 9999) . '.jpg';
        $filePath = storage_path("app/public/articles/{$fileName}");

        $imageData = @file_get_contents("https://picsum.photos/640/480?random=" . rand(1, 10000));
        if ($imageData !== false) {
            file_put_contents($filePath, $imageData);
        }
        return [
            'name' => $fileName,
            'path' => 'articles/' . $fileName,
            'type' => 'image/jpeg',
            'size' => file_exists($filePath) ? filesize($filePath) : null,
            'extension' => 'jpg',
            'created_by' => User::exists()
                ? User::inRandomOrder()->first()->id
                : User::factory(),
        ];
    }
}
