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
                'description' => "Hire the best professionals to fulfill your graphics and design needs!",
            ],
            [
                'name' => "Digital Marketing",
                'description' => "Find people to come up with creative solutions to promote your brand!",
            ],
            [
                'name' => "Writing & Translation",
                'description' => "Create contents with the most creative freelancers.",
            ],
            [
                'name' => "Video & Animation",
                'description' => "Find creators that suits your video needs!",
            ],
            [
                'name' => "Music & Audio",
                'description' => "Need a good quality music/audio for your brand? Find it here!",
            ],
            [
                'name' => "Programming & Tech",
                'description' => "Searching for people to create or maintain your website has never been easier.",
            ],
            [
                'name' => "Business",
                'description' => "Get people to help with your business needs!",
            ],
            [
                'name' => "Lifestyle",
                'description' => "Discover various people that could help improve your life!",
            ],
        ]);
    }
}
