<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'KLIMA UREĐAJI I OPREMA',
                'icon' => 1,
            ],
            [
                'title' => 'FRIŽIDERI',
                'icon' => 3,
            ],
            [
                'title' => 'ZAMRZIVAČI',
                'icon' => 6,
            ],
            [
                'title' => 'ŠPORETI',
                'icon' => 12,
            ],
            [
                'title' => 'MAŠINE ZA PRANJE SUDOVA',
                'icon' => 24,
            ],
            [
                'title' => 'VEŠ MAŠINE',
                'icon' => 36,
            ],
            [
                'title' => 'MIKROTALASNE RERNE',
                'icon' => 0,
            ],
            [
                'title' => 'ASPIRATORI',
                'icon' => 0,
            ],
            [
                'title' => 'BOJLERI',
                'icon' => 0,
            ],
            [
                'title' => 'VENTILATORI',
                'icon' => 0,
            ],
            [
                'title' => 'GREJNA TELA',
                'icon' => 0,
            ],
            [
                'title' => 'UGRADNA TEHNIKA',
                'icon' => 0,
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
