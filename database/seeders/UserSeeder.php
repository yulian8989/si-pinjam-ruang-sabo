<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sabo',
            'nik' => '1234567890123456',
            'phone' => '081234567890',
            'email' => 'admin@sabo.test',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'institution' => 'Balai Teknik Sabo',
            'is_active' => true, 
        ]);

        User::create([
            'name' => 'Staff Tata Usaha',
            'nik' => '1234567890123457',
            'phone' => '081234567891',
            'email' => 'staff@sabo.test',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
            'institution' => 'Balai Teknik Sabo',
            'is_active' => true,
        ]);
    }
}
