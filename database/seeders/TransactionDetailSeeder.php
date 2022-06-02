<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction_header = TransactionHeader::factory()->create();

        TransactionDetail::factory()
            ->count(3)
            ->for($transaction_header)
            ->create();
    }
}
