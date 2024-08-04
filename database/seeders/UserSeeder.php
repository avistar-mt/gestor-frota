<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'firstname' => 'Aguia',
            'lastname' => 'Rastreadores',
            'email' => 'admin@aguia.com',
            'password' =>  Hash::make('secret'),
            'role_id' => 1,
            'branch_id' => 1,
            'cpf' => '12345678909',
            'phone' => '65999234546',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'firstname' => 'Mario',
            'lastname' => 'Nintendo',
            'email' => 'gestor@aguia.com',
            'password' =>  Hash::make('secret'),
            'role_id' => 2,
            'branch_id' => 1,
            'cpf' => '12345678910',
            'phone' => '65999234547',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'firstname' => 'Zelda',
            'lastname' => 'Link',
            'email' => 'gestor@admin.com',
            'password' => Hash::make('secret'),
            'role_id' => 3,
            'cpf' => '12345678911',
            'phone' => '65999234548',
            'branch_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
