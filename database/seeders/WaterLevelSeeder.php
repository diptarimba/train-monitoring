<?php

namespace Database\Seeders;

use App\Models\Wagon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rawNow = Carbon::now();
        $wagon = Wagon::get()->map(function($query) use ($rawNow){
            $tankWagon = 250;
            for($x=0; $x<50; $x++){
                $tankWagon -= mt_rand() / mt_getrandmax();

                $now = $rawNow->addSeconds(1);

                // $bool = rand(0,1) === 1 ? true : false;
                // $newDate = $bool ? $now->addDays(rand(1,14))->addMinutes(rand(10,15)) : $now->subDays(rand(1,14))->addMinutes(rand(10,15));

                $newDate = $now->addMinutes(30);

                $query->water_level()->create(['value' => $tankWagon, 'created_at' => $newDate, 'updated_at' => $newDate]);
            }
        });
    }
}
