<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DebtConfigSeeder extends Seeder
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
                'quant_parcel' => "3",
                'value_tax' => '2',
                'sale_commission' => '10',
                'tax_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($data as $row) {
            $config = DB::table('debt_configs')->find($row['id']);

            if (!$config) {
                DB::table('debt_configs')->insert($row);
            }
        }
    }
}
