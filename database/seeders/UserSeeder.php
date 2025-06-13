<?php

namespace Database\Seeders;

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
        // Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@kingnickel.com',
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
            'superior_id' => null, 
        ]);

        // Membuat User Approver
        $approverLevel2 = User::create([
            'name' => 'David Sugiarto',
            'email' => 'david@kingnickel.com',
            'password' => Hash::make('approver123'), 
            'role' => 'approver',
            'superior_id' => null, 
        ]);

        User::create([
            'name' => 'Anthony Heru',
            'email' => 'heru@kingnickel.com',
            'password' => Hash::make('approver123'), 
            'role' => 'approver',
            'superior_id' => $approverLevel2->id, 
        ]);
    }
}
