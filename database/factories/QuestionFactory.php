<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_title'=> $this->faker->sentence(rand(3,7)),
            'quiz_id' => rand(1,380),
            'chose1' => $this->faker->sentence(rand(1,4)),
            'chose2' => $this->faker->sentence(rand(1,4)),
            'chose3' => $this->faker->sentence(rand(1,4)),
            'chose4' => $this->faker->sentence(rand(1,4)),
            'answer' => rand(1,4),

        ];
    }
}
