<?php

use App\Hotel;
use App\Rate;
use App\User;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(Hotel::class, 3)->create();
    }
}
