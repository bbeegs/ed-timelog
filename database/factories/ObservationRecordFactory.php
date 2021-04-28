<?php

namespace Database\Factories;

use App\Models\ObservationRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObservationRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ObservationRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'area' => $this->faker->randomElement(['A Side', 'B Side', 'C Side', 'Back of B']),
            'observation_start' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null),
            'observation_end' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null),
            'observation_date' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null),
            'total_hours' => $this->faker->numberBetween($min = 1, $max = 5) 
        ];
    }
}
