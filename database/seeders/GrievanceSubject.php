<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
class GrievanceSubject extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    
    public function run(): void
    {
        //
        \App\Models\GrievanceSubject::create([
                'name' => 'Test User',
                'icon_image'=>'testing@123',
                'is_visible'=>false,
            ]);
    }
}
