<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Super Admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Admin Frota',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Gestor',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'Operador',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'id' => 5,
            'name' => 'Motorista',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
