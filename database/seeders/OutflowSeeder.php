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
        $wagon = Wagon::get()->map(function($query){
            $way = $query->water_way->pluck('id')->toArray();
            for($x = 0; $x < 50; $x++)
            {
                $randWayNumb = array_rand($way, 1);
                $randWay = $way[$randWayNumb];

                $now = Carbon::now();
                $randBinary = rand(0,1);
                $bool = $randBinary === 1 ? true : false;
                $newDate = $bool ? $now->addDays(rand(1,14)) : $now->subDays(rand(1,14));

                $query->outflow()->create([
                    'value' => (mt_rand() / mt_getrandmax()),
                    'created_at' => $newDate,
                    'updated_at' => $newDate,
                    'water_way_id' => $randWay,
                ]);
            }
        });
    }
}
