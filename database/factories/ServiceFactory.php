<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::inRandomOrder()->first();
        $random_number = random_int(1, 10000);
        $price = mt_rand(40, 10000)/10;

        return [
            "user_id" => User::inRandomOrder()->first()->id,
            "category_id" => $category->id,
            "name" => $category->name.' Service #'.$random_number,
            "description" => 'A '.$category->name.' service.',
            "price" => $price,
            "picture" => "default.jpg",
        ];
    }
}
