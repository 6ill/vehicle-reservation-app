<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            'name' => 'Kantor Pusat Jakarta',
            'type' => 'kantor_pusat',
            'address' => 'Jl. Jenderal Sudirman Kav. 52-53, Jakarta Selatan',
        ]);

        Location::create([
            'name' => 'Tambang Nikel Sorowako',
            'type' => 'tambang',
            'address' => 'Sorowako, Kabupaten Luwu Timur, Sulawesi Selatan',
        ]);
    }
}
