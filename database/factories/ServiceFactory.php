<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'category_id' => Category::query()->inRandomOrder()->value('id') ?? Category::factory(),
            'name' => ucwords(fake()->words(rand(2, 5), true)),
            'description' => fake()->paragraphs(rand(1, 3), true),
            'price' => fake()->randomFloat(3, 5, 1500),
            'picture' => null,
        ];
    }
}
