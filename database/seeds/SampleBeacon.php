<?php

use Wavvve\Beacon;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;

class SampleBeacon extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beacon::create([
            'user_id' => '1',
            'uuid' => Uuid::uuid4(),
            'hardware_address' => 'b8:27:eb:00:00:00',
            'lon' => '-75.130822',
            'lat' => '39.731958',
            'nickname' => 'beside.hidden.splash',
            'software' => '0.5.10217',
            'hardware' => 'R3',
        ]);
    }
}
