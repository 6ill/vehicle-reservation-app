<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kantorPusat = Location::where('type', 'kantor_pusat')->first();
        $tambang = Location::where('type', 'tambang')->first();

         $drivers = [
            ['name' => 'Ahmad Subarjo', 'phone_number' => '081234567890', 'location_id' => $tambang->id],
            ['name' => 'Budi Santoso', 'phone_number' => '081234567891', 'location_id' => $tambang->id],
            ['name' => 'Cecep Firmansyah', 'phone_number' => '081234567892', 'location_id' => $kantorPusat->id],
            ['name' => 'Dedi Mulyadi', 'phone_number' => '081234567893', 'location_id' => $kantorPusat->id],
        ];

        foreach ($drivers as $driver) {
            Driver::create([
                'name' => $driver['name'],
                'phone_number' => $driver['phone_number'],
                'is_available' => true,
                'location_id' => $driver['location_id']
            ]);
        }
    }
}
