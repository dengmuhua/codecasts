<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Config::factory()->create([
            'title' => 'Laravel+Vue3构建的平台系统',
            'config' => config('system'),
            'logo' => fake()->imageUrl(640, 480),
            'copyright' => '©2021 All rights reserved.',
            'icp' => '粤ICP备2021000000号-1',
            'address' => '广东省广州市天河区',
            'tel' => '13888888888',
            'email' => 'admin@example.com',
            'keywords' => 'Laravel+Vue3',
            'description' => 'Laravel+Vue3构建的平台系统',
        ]);
    }
}
