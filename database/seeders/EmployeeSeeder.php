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
        $approverLevel1 = User::where('email', 'nana.manajer@perusahaan.com')->first();
        $kantorPusat = Location::where('type', 'kantor_pusat')->first();

        // Pastikan data ditemukan sebelum membuat pegawai
        if ($approverLevel1 && $kantorPusat) {
            // Membuat data Pegawai "David"
            Employee::create([
                'name' => 'David (Staf)',
                'employee_id_number' => 'PEG-001',
                'department' => 'Operasional',
                'location_id' => $kantorPusat->id,
                'superior_id' => $approverLevel1->id, // <-- Atasan David adalah Nana
            ]);
        }
    }
}
