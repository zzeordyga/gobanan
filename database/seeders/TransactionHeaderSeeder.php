<?php

namespace Database\Seeders;

use App\Models\TransactionHeader;
use Illuminate\Database\Seeder;

class TransactionHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionHeader::factory()
            ->count(15)
            ->create();
    }
}
