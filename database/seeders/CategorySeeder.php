<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Graphics & Design', 'description' => 'Logos, branding, illustration and visual design.'],
            ['name' => 'Digital Marketing', 'description' => 'SEO, social media, ads and growth strategy.'],
            ['name' => 'Writing & Translation', 'description' => 'Copywriting, editing and multilingual translation.'],
            ['name' => 'Video & Animation', 'description' => 'Editing, motion graphics and animated explainers.'],
            ['name' => 'Music & Audio', 'description' => 'Mixing, mastering, voiceover and composition.'],
            ['name' => 'Programming & Tech', 'description' => 'Web, mobile, devops and database engineering.'],
            ['name' => 'Business', 'description' => 'Consulting, bookkeeping, virtual assistance and plans.'],
            ['name' => 'Lifestyle', 'description' => 'Coaching, fitness, travel planning and organization.'],
        ];

        foreach ($categories as $c) {
            Category::query()->firstOrCreate(['name' => $c['name']], $c);
        }
    }
}
