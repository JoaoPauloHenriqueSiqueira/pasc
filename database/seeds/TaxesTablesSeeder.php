<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaxesTablesSeeder extends Seeder
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
                'name' => "Simples",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 2,
                'name' => "Composto",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($data as $row) {
            $tax = DB::table('taxes')->find($row['id']);

            if (!$tax) {
                DB::table('taxes')->insert($row);
            }
        }
    }
}
