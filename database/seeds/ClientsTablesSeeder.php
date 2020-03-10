<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClientsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "id" => 1,
                'name' => "Pedro Silveira",
                'cpf' => '429.991.440-67',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 2,
                'name' => "Aline Soares",
                'cpf' => '642.036.340-32',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 3,
                'name' => "Robson Cruz",
                'cpf' => '792.320.500-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 4,
                'name' => "Julia Dálio",
                'cpf' => '330.385.240-50',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 5,
                'name' => "Bruno Madoglio",
                'cpf' => '921.914.890-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($data as $row) {
            $client = DB::table('clients')->find($row['id']);

            if (!$client) {
                DB::table('clients')->insert($row);
            }
        }
    }
}
