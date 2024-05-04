<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'RS GRHA PERMATA IBU',
            'website' => 'www.grhapermataibu.com',
            'email' => 'grhapermataibu@gmail.com',
            'phone_number' => '081234567890',
            'latitude' => '-6.4275136',
            'longitude' => '106.8360662',
            'address' => 'Jl. Permata Ibu No. 123',
            'radius_km' => '0.5',
            'time_in' => '08:00:00',
            'time_out' => '17:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
