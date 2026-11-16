<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'service_id' => Service::query()->inRandomOrder()->value('id') ?? Service::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
        ];
    }
}
