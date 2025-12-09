<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Conference::create([
            'title' => 'Laravel Conference 2024',
            'description' => 'The biggest Laravel conference in the region.',
            'date' => '2024-10-15',
            'address' => 'Vilnius, Litexpo',
            'participants' => 500,
        ]);

        \App\Models\Conference::create([
            'title' => 'Tech Summit LT',
            'description' => 'General technology conference covering AI, Web, and Cloud.',
            'date' => '2024-11-20',
            'address' => 'Kaunas, Zalgirio Arena',
            'participants' => 300,
        ]);
    }
}
