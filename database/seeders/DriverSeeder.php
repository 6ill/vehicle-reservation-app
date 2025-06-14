<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $drivers = [
            ['name' => 'Ahmad Subarjo', 'phone_number' => '081234567890'],
            ['name' => 'Budi Santoso', 'phone_number' => '081234567891'],
            ['name' => 'Cecep Firmansyah', 'phone_number' => '081234567892'],
            ['name' => 'Dedi Mulyadi', 'phone_number' => '081234567893'],
        ];

        foreach ($drivers as $driver) {
            Driver::create([
                'name' => $driver['name'],
                'phone_number' => $driver['phone_number'],
                'is_available' => true,
            ]);
        }
    }
}
