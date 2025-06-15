<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kantorPusat = Location::where('type', 'kantor_pusat')->first();
        $tambang = Location::where('type', 'tambang')->first();

        
        User::create([
            'name' => 'Admin Kantor Pusat',
            'email' => 'admin.pusat@kingnickel.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'superior_id' => null,
            'location_id' => $kantorPusat->id, 
        ]);

        
        User::create([
            'name' => 'Admin Tambang',
            'email' => 'admin.tambang@kingnickel.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'superior_id' => null,
            'location_id' => $tambang->id, 
        ]);
        
        
        $approverLevel2 = User::create([
            'name' => 'Nini (Kepala Divisi)',
            'email' => 'nini.kepdiv@kingnickel.com',
            'password' => Hash::make('password123'),
            'role' => 'approver',
            'location_id' => $kantorPusat->id,
            'superior_id' => null,
        ]);

        User::create([
            'name' => 'Nana (Manajer)',
            'email' => 'nana.manajer@kingnickel.com',
            'password' => Hash::make('password123'),
            'role' => 'approver',
            'location_id' => $kantorPusat->id,
            'superior_id' => $approverLevel2->id,
        ]);
        
        $approverLevel2 = User::create([
            'name' => 'David Sugiarto',
            'email' => 'david@kingnickel.com',
            'password' => Hash::make('password123'), 
            'role' => 'approver',
            'location_id' => $tambang->id,
            'superior_id' => null, 
        ]);

        User::create([
            'name' => 'Anthony Heru',
            'email' => 'heru@kingnickel.com',
            'password' => Hash::make('password123'), 
            'role' => 'approver',
            'location_id' => $tambang->id,
            'superior_id' => $approverLevel2->id, 
        ]);
    }
}
