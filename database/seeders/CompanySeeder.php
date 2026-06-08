<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; 

//Company seeder for populating the logos from storage to the database

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Overriding factory defaults to seed 15 local logos...');

        //loops through all current company entiries
        for ($i = 1; $i <= 15; $i++) {
            $existingPath = 'logos/' . $i . '.jpg';

            // Passing the array inside create() forces the factory to use this exact value
            //matches the companies to their logo where the logo name number matches their id
            Company::where('id', $i)->update([
                'logo' => $existingPath,
            ]);

        $this->command->info('Successfully seeded all 15 companies!');
        }
    }
}