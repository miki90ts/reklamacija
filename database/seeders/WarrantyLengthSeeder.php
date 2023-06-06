<?php

namespace Database\Seeders;

use App\Models\WarrantyLength;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WarrantyLengthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warrantyLengths = [
            [
                'title' => '1 Mesec',
                'months' => 1,
            ],
            [
                'title' => '3 Meseca',
                'months' => 3,
            ],
            [
                'title' => '6 Meseci',
                'months' => 6,
            ],
            [
                'title' => '1 Godina',
                'months' => 12,
            ],
            [
                'title' => '2 Godine',
                'months' => 24,
            ],
            [
                'title' => '3 Godine',
                'months' => 36,
            ],
            [
                'title' => 'Doživotna garancija',
                'months' => 0,
            ],
        ];

        foreach ($warrantyLengths as $warrantyLength) {
            WarrantyLength::create($warrantyLength);
        }
    }
}
