<?php

use Wavvve\User;
use Illuminate\Database\Seeder;

class NightMarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=18; $i++)
        {
            User::create(
            [
                'email' => 'nightmarket'.$i.'@atmtllc.com',
                'password' => bcrypt('password'),
                'subscribed' => '1',
                'name' => 'Night Market Account #'.$i,
                'username' => 'nm'.$i,
            ]);
            echo "Created account number " . $i ."!\r\n";
        }
    }
}
