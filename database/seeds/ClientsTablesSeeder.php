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
                'cpf' => '42999144067',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 2,
                'name' => "Aline Soares",
                'cpf' => '64203634032',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 3,
                'name' => "Robson Cruz",
                'cpf' => '79232050005',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 4,
                'name' => "Julia Dálio",
                'cpf' => '33038524050',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 5,
                'name' => "Bruno Madoglio",
                'cpf' => '92191489001',
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
