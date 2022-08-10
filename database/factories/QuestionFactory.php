<?php

namespace Database\Factories;

use App\Models\SupSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'textOfQuestion' => $this->faker->text,
            'sub_subject_id' => SupSubject::inRandomOrder()->first()->id,
        ];
    }
}
