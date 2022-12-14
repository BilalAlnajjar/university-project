<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\GeneralPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GeneralPlan>
 */
class GeneralPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'department_id' => Department::inRandomOrder()->first()->id,
        ];
    }
}
