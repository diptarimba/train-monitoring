<?php

namespace Database\Seeders;

use App\Models\Wagon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutflowSeeder extends Seeder
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
            $way = $query->water_way->pluck('id')->toArray();
            for($x = 0; $x < 50; $x++)
            {
                $randWayNumb = array_rand($way, 1);
                $randWay = $way[$randWayNumb];

                $now = $rawNow->addSeconds(1);
                $randBinary = rand(0,1);
                $bool = $randBinary === 1 ? true : false;
                $newDate = $bool ? $now->addDays(rand(1,14)) : $now->subDays(rand(1,14));

                $open_date = $rawNow->copy()->subSeconds(rand(10,600));
                $close_date = $open_date->copy()->addSeconds(rand(10,600));

                $query->outflow()->create([
                    'value' => (mt_rand() / mt_getrandmax()),
                    'created_at' => $newDate,
                    'updated_at' => $newDate,
                    'water_way_id' => $randWay,
                    'open_date' => $open_date->format('Y-m-d H:i:s'),
                    'close_date' => $close_date->format('Y-m-d H:i:s')
                ]);
            }
        });
    }
}
