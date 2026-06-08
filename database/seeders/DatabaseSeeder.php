<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // seeds the admin user login info
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        ); 

        // runs the factories when seeded 
        $companies = Company::factory(15)->create();

        Employee::factory(30)->create([
            'company_id' => function () use ($companies) {
                return $companies->random()->id; // assigns each employee to a company randomly
            }
        ]);
    } 
} 