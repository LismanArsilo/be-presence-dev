<?php

namespace Database\Seeders;

use App\Models\ServiceUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceUnit::create([
            'name' => 'IT'
        ]);

        ServiceUnit::create([
            'name' => 'Finance'
        ]);

        ServiceUnit::create([
            'name' => 'Human Resource'
        ]);
    }
}
