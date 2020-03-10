<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTablesSeeder::class);
        $this->call(ClientsTablesSeeder::class);
        $this->call(TaxesTablesSeeder::class);
        $this->call(DebtConfigSeeder::class);
        $this->call(DebtTableSeeder::class);

    }
}
