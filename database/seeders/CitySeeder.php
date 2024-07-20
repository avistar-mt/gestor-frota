<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            'id' => 1,
            'name' => 'Cuiabá',
            'state_id' => 11,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
