<?php

namespace Database\Seeders;

use App\Models\ComplaintCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ComplaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComplaintCategory::factory()->state(new Sequence(
            ['name' => 'Toilet'],
            ['name' => 'AC'],
            ['name' => 'Tempat Duduk'],
            ['name' => 'Kebersihan'],
            ['name' => 'Kenyamanan'])
        )->create();

    }
}
