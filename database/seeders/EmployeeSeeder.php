<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'employee_id' => 'EMP001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+254712345678',
                'department' => 'IT',
                'position' => 'Software Developer',
                'hire_date' => '2024-01-15',
                'is_active' => true,
            ],
            [
                'employee_id' => 'EMP002',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+254712345679',
                'department' => 'HR',
                'position' => 'HR Manager',
                'hire_date' => '2024-02-01',
                'is_active' => true,
            ],
            [
                'employee_id' => 'EMP003',
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michael.johnson@example.com',
                'phone' => '+254712345680',
                'department' => 'Finance',
                'position' => 'Accountant',
                'hire_date' => '2024-03-10',
                'is_active' => true,
            ],
            [
                'employee_id' => 'EMP004',
                'first_name' => 'Sarah',
                'last_name' => 'Williams',
                'email' => 'sarah.williams@example.com',
                'phone' => '+254712345681',
                'department' => 'Marketing',
                'position' => 'Marketing Specialist',
                'hire_date' => '2024-04-20',
                'is_active' => true,
            ],
            [
                'employee_id' => 'EMP005',
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david.brown@example.com',
                'phone' => '+254712345682',
                'department' => 'Operations',
                'position' => 'Operations Manager',
                'hire_date' => '2024-05-05',
                'is_active' => true,
            ],
        ];

        foreach ($employees as $employeeData) {
            // Generate QR code for each employee
            $employeeData['qr_code'] = Str::uuid()->toString();
            
            Employee::create($employeeData);
        }

        $this->command->info('Sample employees created successfully!');
    }
}
