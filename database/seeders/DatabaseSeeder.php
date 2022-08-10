<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Department;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SupSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Department::factory(10)->create();
        Subject::factory(10)->create();
        SupSubject::factory(10)->create();
        Question::factory(10)->create();
        Answer::factory(10)->create();
    }
}
