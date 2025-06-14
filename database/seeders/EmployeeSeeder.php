<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manajer = User::where('email', 'heru@kingnickel.com')->first();
        $kantorPusat = Location::where('type', 'kantor_pusat')->first();
        $tambang = Location::where('type', 'tambang')->first();
        
        $employees = [
            [
                'name' => 'David (Staf Operasional)',
                'employee_id_number' => 'PEG-001',
                'department' => 'Operasional',
                'location_id' => $tambang->id,
                'superior_id' => $manajer->id,
            ],
            [
                'name' => 'Eka (Staf Keuangan)',
                'employee_id_number' => 'PEG-002',
                'department' => 'Keuangan',
                'location_id' => $kantorPusat->id,
                'superior_id' => $manajer->id,
            ],
            [
                'name' => 'Fitri (Staf HR)',
                'employee_id_number' => 'PEG-003',
                'department' => 'Human Resources',
                'location_id' => $kantorPusat->id,
                'superior_id' => $manajer->id,
            ],
        ];

        foreach($employees as $employee) {
            Employee::create($employee);
        }

    }
}
