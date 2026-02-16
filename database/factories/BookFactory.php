<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 0, 300),
            'is_available' => $this->faker->boolean(50),
            'tags' => $this->faker->randomElements(['fiction', 'non-fiction', 'science', 'history', 'fantasy', 'biography'], rand(1, 3)),
            'document' => $this->faker->url(),
            'pages' => $this->faker->randomNumber(3),
            'visits' => $this->faker->randomNumber(4),
            'picture' => $this->faker->imageUrl(),
        ];
    }
}
