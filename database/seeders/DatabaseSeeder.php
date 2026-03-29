<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JetskiPackage;
use App\Models\booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@jetski.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // //create booking
        // booking::create([
        //     'user_id' => 1, // Assuming the first user is the admin
        //     'jetski_package_id' => 1, // Assuming the first package exists
        //     'booking_date' => now()->addDays(1), // Tomorrow
        //     'booking_time' => now()->addHours(2)->format('H:i'), // Two hours from now
        //     'total_price' => 300000, // Example price
        //     'status' => 'pending', // Initial status
        //     'notes' => 'Please prepare the jetski for my booking.',
        // ]);

        // Create jetski packages
        JetskiPackage::create([
            'name' => 'Paket 30 Menit',
            'duration' => 30,
            'price' => 300000,
            'description' => 'Paket ideal untuk pemula yang ingin merasakan sensasi berkendara jetski.',
        ]);

        JetskiPackage::create([
            'name' => 'Paket 50 Menit',
            'duration' => 50,
            'price' => 600000,
            'description' => 'Paket extended untuk pengalaman jetski yang lebih puas dan menyenangkan.',
        ]);
    }
}