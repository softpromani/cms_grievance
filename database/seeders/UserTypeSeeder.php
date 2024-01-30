<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'student'],
            ['name' => 'parent'],
            ['name' => 'teacher'],
            ['name' => 'non-teacher'],
            // Add more products as needed
        ];
        DB::table('user_types')->insert($users);
        // \App\Models\UserType::create([
        //     'name' => 'student',
        // ]);
    }
}
