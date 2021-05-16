<?php

namespace Database\Factories;

use App\Models\Kurum;
use Illuminate\Database\Eloquent\Factories\Factory;

class KurumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kurum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kurum_adi'=>$this->faker->company()
        ];
    }
}
