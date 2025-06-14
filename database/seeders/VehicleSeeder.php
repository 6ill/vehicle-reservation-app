<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kantorPusat = Location::where('type', 'kantor_pusat')->first();
        $tambang = Location::where('type', 'tambang')->first();
        $vehicles = [
            [
                'name' => 'Toyota Hilux 4x4',
                'license_plate' => 'DD 1234 TM',
                'type' => 'angkutan_barang',
                'ownership' => 'company',
                'base_location_id' => $tambang->id,
                'status' => 'available',
            ],
            [
                'name' => 'Mitsubishi Pajero Sport',
                'license_plate' => 'DD 5678 OP',
                'type' => 'angkutan_orang',
                'ownership' => 'company',
                'base_location_id' => $tambang->id,
                'status' => 'available',
            ],
            [
                'name' => 'Toyota Avanza',
                'license_plate' => 'B 9101 KT',
                'type' => 'angkutan_orang',
                'ownership' => 'rental',
                'base_location_id' => $kantorPusat->id,
                'status' => 'available',
            ],
            [
                'name' => 'Daihatsu Gran Max',
                'license_plate' => 'B 1121 LG',
                'type' => 'angkutan_barang',
                'ownership' => 'rental',
                'base_location_id' => $kantorPusat->id,
                'status' => 'maintenance',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
