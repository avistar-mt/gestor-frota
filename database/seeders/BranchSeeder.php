<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            'id' => 1,
            'name' => 'Filial SESC Cuiabá',
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
