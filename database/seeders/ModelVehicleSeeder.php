<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $models =  [ 
            ['id' => 1, 'name' => 'Caminhão', 'created_at' => now(), 'updated_at' => now()], 
            ['id' => 2, 'name' => 'Caminhonete', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Hatch', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Reboque', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Sedan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'SUV-4x4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Utilitário Leve', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Van', 'created_at' => now(), 'updated_at' => now()]
        ];

        DB::table('model_vehicles')->insert($models);

    }
}
