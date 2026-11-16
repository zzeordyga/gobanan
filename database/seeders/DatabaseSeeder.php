<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Service;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! User::query()->where('email', 'admin@gobanan.test')->exists()) {
            User::factory()->admin()->create([
                'name' => 'Site Admin',
                'username' => 'admin',
                'email' => 'admin@gobanan.test',
            ]);
        }

        if (! User::query()->where('email', 'seller@gobanan.test')->exists()) {
            $seller = User::factory()->create([
                'name' => 'Demo Seller',
                'username' => 'demoseller',
                'email' => 'seller@gobanan.test',
            ]);
            // Give the demo seller a richer portfolio
            Service::factory()->count(8)->for($seller, 'user')->create();
        }

        $this->call([
            CategorySeeder::class,
        ]);

        // A full demo dataset
        User::factory()->count(30)->create();
        Service::factory()->count(60)->create();
        Review::factory()->count(120)->create();
        User::factory()->count(15)->has(Cart::factory()->count(3))->create();
        TransactionHeader::factory()->count(20)
            ->has(TransactionDetail::factory()->count(3), 'details')
            ->create();
    }
}
