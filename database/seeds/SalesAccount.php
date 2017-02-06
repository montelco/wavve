<?php

use Illuminate\Database\Seeder;
use Wavvve\User;

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
            'subscribed' => 1,
            'name' => 'Churchill Coffee',
            'username' => 'churchill-coffee',
        ]);
    }
}
