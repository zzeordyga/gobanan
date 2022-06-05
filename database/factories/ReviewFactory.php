<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::inRandomOrder()->first()->id,
            "service_id" => Service::inRandomOrder()->first()->id,
            "title" => "Very Good!",
            "description" => "Very much good!",
            "rating" => mt_rand(3, 5),
        ];
    }
}
