<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'email' => 'admin@edu.com',
            'name' => 'Admin',
            'password' => Hash::make('course2025'),
            'is_admin' => true,
        ]);

        User::create([
            'email' => 'ivan@example.com',
            'name' => 'Ivan',
            'password' => Hash::make('123aA_'),
        ]);

        Course::factory()
            ->has(Lesson::factory()->count(5))
            ->count(10)
            ->create();
    }
}
