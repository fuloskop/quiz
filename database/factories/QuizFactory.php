<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;


class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $isnotuniqe=true;
        while($isnotuniqe){
            $uniqe_id=bin2hex(random_bytes(10));
            if(Quiz::where('uniqe_id', $uniqe_id)->first()==null){
                $isnotuniqe=false;
            }

        }
        return [
            'quiz_title'=>$this->faker->sentence(rand(3,7)),
            'quiz_description'=>$this->faker->text(200),
            'kurum_id'=>rand(1,8),
            'uniqe_id' => $uniqe_id,
        ];
    }
}
