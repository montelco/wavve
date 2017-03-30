<?php

use Wavvve\User;
use Illuminate\Database\Seeder;

class SalesAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'sales@atmtllc.com',
            'password' => bcrypt('password'),
            'subscribed' => '1',
            'name' => 'Churchill Coffee',
            'username' => 'churchill-coffee',
            'active' => '1',
        ]);
    }
}
