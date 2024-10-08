<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeadquarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $headquarters = [

            ['id' => 1, 'name' => 'FIEMT', 'created_at' => now(), 'updated_at'=> now()],
            ['id' => 2, 'name' => 'Sesi', 'created_at' => now(), 'updated_at'=> now()],
            ['id' => 3, 'name' => 'Senai', 'created_at' => now(), 'updated_at'=> now()],
            ['id' => 4, 'name' => 'IEL', 'created_at' => now(), 'updated_at'=> now()],
        ];

        DB::table('headquarters')->insert($headquarters);
    }
}
