<?php

use Wavvve\Pass;
use Illuminate\Database\Seeder;

class SamplePass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pass::create([
            'user_id' => '1',
            'title' => 'Free WiFi',
            'template_number' => '1',
            'primary_field' => 'Energise your day at Endgrain with some java and free wifi to go with it!',
            'secondary_field' => 'Ask your barista for today\'s password at time of order.',
            'barcode_value' => '',
            'cashier_helper' => 'Please enter pass through Square.',
            'published' => '1', 
            'strip_background_image' => '',
            'coupon_full_background_image' => 'https://ucarecdn.com/a9537dc6-a822-4d01-8f97-ae62133f96c7/-/crop/2178x2900/858,955/-/preview/',
            'expiry' => '',
            'uuid' => str_random(7),
        ]);
    }
}
