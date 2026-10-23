<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'aloyceotieno254@gmail.com'],
            [
                'name' => 'ALOYCE OTIENO',
                'email' => 'aloyceotieno254@gmail.com',
                'password' => Hash::make('aloyceM @254!!'),
                'is_admin' => true,
            ]
        );

        // Create sample employees
        $this->call([
            EmployeeSeeder::class,
        ]);
    }
}
