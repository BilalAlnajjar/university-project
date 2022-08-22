<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\CustomerPlan;
use App\Models\Department;
use App\Models\GeneralPlan;
use App\Models\Question;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubMajor;
use App\Models\SupSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        Student::factory(10)->create();
        GeneralPlan::factory(10)->create();
        CustomerPlan::factory(10)->create();
        SubMajor::factory(10)->create();
        Subject::factory(10)->create();
        SupSubject::factory(10)->create();
        Question::factory(10)->create();
        Answer::factory(10)->create();

        for($i=0;$i<10;++$i){
            DB::table('subject_customer_plan')->insert(
                [
                    "customer_plan_id" => CustomerPlan::inRandomOrder()->first()->id,
                    "subject_id" => Subject::inRandomOrder()->first()->id
                ]);
        }

        for($i=0;$i<10;++$i){
            DB::table('subject_general_plan')->insert(
                [
                    "general_plan_id" => GeneralPlan::inRandomOrder()->first()->id,
                    "subject_id" => Subject::inRandomOrder()->first()->id
                ]);
        }

    }
}
