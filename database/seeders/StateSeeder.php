<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $states = [
            ['id' => 1, 'name' => 'Acre', 'uf' => 'AC', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Alagoas', 'uf' => 'AL', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Amapá', 'uf' => 'AP', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Amazonas', 'uf' => 'AM', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Bahia', 'uf' => 'BA', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Ceará', 'uf' => 'CE', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Distrito Federal', 'uf' => 'DF', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Espírito Santo', 'uf' => 'ES', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'Goiás', 'uf' => 'GO', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'Maranhão', 'uf' => 'MA', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'name' => 'Mato Grosso', 'uf' => 'MT', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'name' => 'Mato Grosso do Sul', 'uf' => 'MS', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'name' => 'Minas Gerais', 'uf' => 'MG', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'name' => 'Pará', 'uf' => 'PA', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'name' => 'Paraíba', 'uf' => 'PB', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'name' => 'Paraná', 'uf' => 'PR', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'name' => 'Pernambuco', 'uf' => 'PE', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'name' => 'Piauí', 'uf' => 'PI', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'name' => 'Rio de Janeiro', 'uf' => 'RJ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'name' => 'Rio Grande do Norte', 'uf' => 'RN', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'name' => 'Rio Grande do Sul', 'uf' => 'RS', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'name' => 'Rondônia', 'uf' => 'RO', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'name' => 'Roraima', 'uf' => 'RR', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 24, 'name' => 'Santa Catarina', 'uf' => 'SC', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 25, 'name' => 'São Paulo', 'uf' => 'SP', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 26, 'name' => 'Sergipe', 'uf' => 'SE', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 27, 'name' => 'Tocantins', 'uf' => 'TO', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('states')->insert($states);
    }
}
