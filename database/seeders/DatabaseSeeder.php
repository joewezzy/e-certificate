<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => "Isaac Boakye-Manu",
            'email' => "isaac@gmail.com",
            'password' => Hash::make('123@Isaac#'),
        ]);

        // \App\Models\certificate::create([
        //     'name' => "Michael Esson Asante",
        //     'email' => "mike17gh@gmail.com",
        //     'type' => 'Attendance',
        //     'unique_code' => 'OAHF/AT/2304002',
        //     'hash' => sha1(rand()),
        // ]);

        // \App\Models\certificate::create([
        //     'name' => "Abdulsalam Mohammed Daaru",
        //     'email' => "corporatehealthghana@gmail.com",
        //     'type' => 'Attendance',
        //     'unique_code' => 'OAHF/AT/2304003',
        //     'hash' => sha1(rand()),
        // ]);
    }
}
