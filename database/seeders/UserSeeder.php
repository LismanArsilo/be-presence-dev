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
        User::create([
            'username' => 'Admin',
            'fullname' => 'Admin',
            'role_id' => 1,
            'position_id' => 1,
            'unit_id' => 1,
            'phone' => '085212357699',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        User::create([
            'username' => 'Syifa',
            'fullname' => 'Syifa Fadilah',
            'role_id' => 2,
            'position_id' => 2,
            'unit_id' => 3,
            'phone' => '085212357699',
            'email' => 'syifa@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        User::create([
            'username' => 'Mira',
            'fullname' => 'Mira Syahmadi',
            'role_id' => 2,
            'position_id' => 1,
            'unit_id' => 3,
            'phone' => '085212357699',
            'email' => 'mirasyahmadi@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        User::create([
            'username' => 'Lisman',
            'fullname' => 'Lisman Arsilo',
            'role_id' => 4,
            'position_id' => 1,
            'unit_id' => 1,
            'phone' => '085212357699',
            'email' => 'lismanarsilo@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        User::create([
            'username' => 'Luluk',
            'fullname' => 'Luluk Fitriyani',
            'role_id' => 4,
            'position_id' => 2,
            'unit_id' => 1,
            'phone' => '085212357699',
            'email' => 'lulukfitriyani@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'username' => 'Joko',
            'fullname' => 'Joko Asmara',
            'role_id' => 4,
            'position_id' => 2,
            'unit_id' => 1,
            'phone' => '085212357699',
            'email' => 'jokoasmara@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        User::create([
            'username' => 'Budi',
            'fullname' => 'Budi Asmara',
            'role_id' => 3,
            'position_id' => 1,
            'unit_id' => 1,
            'phone' => '085212357699',
            'email' => 'budiasmara@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
