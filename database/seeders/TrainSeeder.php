<?php

namespace Database\Seeders;

use App\Models\Train;
use App\Models\Wagon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Train::factory()->count(5)->create()->map(function($each){
            Wagon::factory()->count(5)->state(new Sequence(
                ['name' => 'Gerbong 1', 'train_id' => $each->id],
                ['name' => 'Gerbong 2', 'train_id' => $each->id],
                ['name' => 'Gerbong 3', 'train_id' => $each->id],
                ['name' => 'Gerbong 4', 'train_id' => $each->id],
                ['name' => 'Gerbong 5', 'train_id' => $each->id]
            ))->create();
        });
    }
}
