<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\TransactionHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = ["Done", "Payment Pending", "Ongoing"];

        return [
            "header_id" => TransactionHeader::inRandomOrder()->first()->id,
            "service_id" => Service::inRandomOrder()->first()->id,
            "status" => $statuses[array_rand($statuses)],
        ];
    }
}
