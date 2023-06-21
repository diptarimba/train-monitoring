<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Train;
use App\Models\Wagon;
use App\Models\Waterways;
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
        $trainData = [
            [
                'name' => 'Argo Sindoro',
                'wagonCount' => 8,
            ],
            [
                'name' => 'Brawijaya',
                'wagonCount' => 8,
            ],
            [
                'name' => 'Sembrani',
                'wagonCount' => 9,
            ],
        ];

        foreach ($trainData as $data) {
            Train::factory()->count(1)->state(new Sequence(
                ['name' => $data['name']]
            ))->create()->map(function ($train) use ($data) {
                Wagon::factory()->count($data['wagonCount'])->state(new Sequence(
                    ['name' => 'Eksekutif 1', 'train_id' => $train->id],
                    ['name' => 'Eksekutif 2', 'train_id' => $train->id],
                    ['name' => 'Eksekutif 3', 'train_id' => $train->id],
                    ['name' => 'Eksekutif 4', 'train_id' => $train->id],
                    ['name' => 'Eksekutif 5', 'train_id' => $train->id],
                    ['name' => 'Eksekutif 6', 'train_id' => $train->id],
                    ['name' => 'Eksekutif 7', 'train_id' => $train->id],
                    ['name' => 'Eksekutif 8', 'train_id' => $train->id],
                    // For Sembrani train
                    ['name' => 'Eksekutif 9', 'train_id' => $train->id],
                ))->create()->map(function ($each) use ($train) {
                    for ($x = 1; $x < 3; $x++) {
                        $waterWays = Waterways::create([
                            'name' => 'Toilet ' . $x,
                            'wagon_id' => $each->id,
                        ]);
                    }
                    Complaint::factory()->count(10)->state(new Sequence(['wagon_id' => $each->id, 'category_id' => rand(1, 5)]))->create();
                });
            });
        }
    }
}
