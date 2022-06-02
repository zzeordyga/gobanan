<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => "Graphics & Design",
            ],
            [
                'name' => "Digital Marketing",
            ],
            [
                'name' => "Writing & Translation",
            ],
            [
                'name' => "Video & Animation",
            ],
            [
                'name' => "Music & Audio",
            ],
            [
                'name' => "Programming & Tech",
            ],
            [
                'name' => "Business",
            ],
            [
                'name' => "Lifestyle",
            ],
        ]);
    }
}
