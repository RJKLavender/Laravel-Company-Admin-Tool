<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; 

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Overriding factory defaults to seed 15 local logos...');

        for ($i = 1; $i <= 15; $i++) {
            $existingPath = 'logos/' . $i . '.jpg';

            // Passing the array inside create() forces the factory to use this exact value
            Company::factory()->create([
                'logo' => $existingPath,
            ]);
        }

        $this->command->info('Successfully seeded all 15 companies!');
    }
}