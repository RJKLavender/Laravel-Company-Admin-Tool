<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Company; 
use Illuminate\Database\Eloquent\Factories\Factory;


class EmployeeFactory extends Factory
{
   
    public function definition(): array
    {
       return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            
            // Automatically creates a company record to link this employee to
            'company_id' => Company::factory(), 
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
