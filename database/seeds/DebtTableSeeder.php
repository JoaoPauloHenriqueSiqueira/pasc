<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DebtTableSeeder extends Seeder
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
                'value' => "800.00",
                'client_id' => '1',
                'created_at' => '2020-03-01 00:00:00',
                'updated_at' => '2020-03-01 00:00:00'
            ],
            [
                "id" => 2,
                'value' => "150.00",
                'client_id' => '1',
                'created_at' => '2020-02-01 00:00:00',
                'updated_at' => '2020-02-01 00:00:00'
            ],
            [
                "id" => 3,
                'value' => "400.00",
                'client_id' => '1',
                'created_at' => '2020-01-07 00:00:00',
                'updated_at' => '2020-01-07 00:00:00'
            ],
            [
                "id" => 4,
                'value' => "200.00",
                'client_id' => '3',
                'created_at' => '2020-03-10 00:00:00',
                'updated_at' => '2020-03-10 00:00:00'
            ],
            [
                "id" => 5,
                'value' => "243",
                'client_id' => '5',
                'created_at' => '2020-03-08 00:00:00',
                'updated_at' => '2020-03-08 00:00:00'
            ]
        ];

        foreach ($data as $row) {
            $config = DB::table('debts')->find($row['id']);

            if (!$config) {
                DB::table('debts')->insert($row);
            }
        }
    }
}
