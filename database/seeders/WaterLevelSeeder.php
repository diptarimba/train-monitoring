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
        $wagon = Wagon::get()->map(function($query){
            for($x=0; $x<50; $x++){
                $now = Carbon::now();
                $bool = rand(0,1) === 1 ? true : false;
                $newDate = $bool ? $now->addDays(rand(1,14)) : $now->subDays(rand(1,14));
                $query->water_level()->create(['value' => (mt_rand() / mt_getrandmax()), 'created_at' => $newDate, 'updated_at' => $newDate]);
            }
        });
    }
}