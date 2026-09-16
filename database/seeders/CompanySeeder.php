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
            'name' => 'PT Kecap',
            'email' => 'kecap@example.com',
            'address' => '123 Example Street',
            'phone_number' => '123-456-7890',
        ]);
    }
}
