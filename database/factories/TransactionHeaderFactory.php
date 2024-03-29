<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $payment_types = ["Credit", "Debit"];

        return [
            "user_id" => User::inRandomOrder()->first()->id,
            "payment_type" => $payment_types[array_rand($payment_types)],
        ];
    }
}
