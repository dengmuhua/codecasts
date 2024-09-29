<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Config>
 */
class ConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
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
        ];
    }
}
