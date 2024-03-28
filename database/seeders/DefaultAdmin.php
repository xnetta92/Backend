<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'first_name' => 'Bella',
                'last_name' => 'Italia',
                'phone' => '123-456-7890',
                'address' => '123 Main St',
                'city' => 'Anytown',
                'zip' => 12345,
                'role' => 'admin',
                'email' => $_ENV['ADMIN_EMAIL'],
                'password' => bcrypt('Passw0rd'),
            ]
            );
    }
}
