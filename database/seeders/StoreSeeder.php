<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'title' => 'Gigatron',
                'city' => 'Beograd',
                'address' => 'Kirovljeva 17',
                'phone' => '011 354 1379',
                'email' => 'g1@gigatronshop.com',
            ],
            [
                'title' => 'Tehnomanija',
                'city' => 'Batajnica',
                'address' => 'Stanka Tišme 15',
                'phone' => '011 3713 713',
                'email' => 'prodaja@tehnomanija.rs',
            ],
            [
                'title' => 'Fashion&Friends',
                'city' => 'Beograd',
                'address' => 'Mihaila Pupina 115b',
                'phone' => '011 3532 497',
                'email' => 'podrska.rs@fashionandfriends.com',
            ],
            [
                'title' => 'Djak Sport',
                'city' => 'Novi Beograd',
                'address' => 'Bulevar Arsenija Čarnojevića 69',
                'phone' => '0800 100 505',
                'email' => 'kontaktcentar@djaksport.com',
            ], 
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
