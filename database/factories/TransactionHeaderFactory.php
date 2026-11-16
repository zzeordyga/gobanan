<?php

namespace Database\Factories;

use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionHeader>
 */
class TransactionHeaderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'payment_type' => fake()->randomElement(['Debit', 'Credit', 'Bank Transfer', 'E-Wallet']),
        ];
    }
}
