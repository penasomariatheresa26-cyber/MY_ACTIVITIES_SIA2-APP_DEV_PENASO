<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
        PlantSeeder::class,
    ]);
        $plants = [
            ['name' => 'Aloe Vera', 'type' => 'Succulent', 'water_frequency' => 7, 'sunlight' => 'Partial Sun', 'image' => null],
            ['name' => 'Peace Lily', 'type' => 'Flower', 'water_frequency' => 5, 'sunlight' => 'Indirect Light', 'image' => null],
            ['name' => 'Basil', 'type' => 'Herb', 'water_frequency' => 3, 'sunlight' => 'Full Sun', 'image' => null],
            ['name' => 'Spider Plant', 'type' => 'Indoor', 'water_frequency' => 4, 'sunlight' => 'Indirect Light', 'image' => null],
            ['name' => 'Rose', 'type' => 'Flower', 'water_frequency' => 3, 'sunlight' => 'Full Sun', 'image' => null],
            ['name' => 'Mint', 'type' => 'Herb', 'water_frequency' => 2, 'sunlight' => 'Partial Sun', 'image' => null],
            ['name' => 'Jade Plant', 'type' => 'Succulent', 'water_frequency' => 10, 'sunlight' => 'Full Sun', 'image' => null],
            ['name' => 'Lavender', 'type' => 'Herb', 'water_frequency' => 4, 'sunlight' => 'Full Sun', 'image' => null],
            ['name' => 'Orchid', 'type' => 'Flower', 'water_frequency' => 5, 'sunlight' => 'Indirect Light', 'image' => null],
            ['name' => 'Snake Plant', 'type' => 'Indoor', 'water_frequency' => 14, 'sunlight' => 'Low Light', 'image' => null],
        ];

        foreach ($plants as $plant) {
            Plant::create($plant);
        }
    }
}