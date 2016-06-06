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
		/**
		 * Former ACL. Now using Laravel Entrust. 
		 */
		
        //$this->call(RoleTableSeeder::class);
        //$this->call(BaseAccountsTableSeeder::class);
    }
}
