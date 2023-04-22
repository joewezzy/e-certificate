<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\certificate;
use Illuminate\Support\Facades\Hash;

class CertificateTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificate = [
            'name' => "Isaac Boakye-Manu",
            'email' => "isaac@gmail.com",
            'type' => 'Attendance',
            'unique_code' => 'OAHF/AT/2304001',
            'hash' => Hash::make(rand()),
        ];
    }
}
