<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionDetail>
 */
class TransactionDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'header_id' => TransactionHeader::query()->inRandomOrder()->value('id') ?? TransactionHeader::factory(),
            'service_id' => Service::query()->inRandomOrder()->value('id') ?? Service::factory(),
            'notes' => fake()->optional(0.3)->sentence(),
            'status' => fake()->randomElement(['Ongoing', 'Done']),
        ];
    }
}
