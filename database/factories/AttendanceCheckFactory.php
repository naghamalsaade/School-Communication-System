<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'type' => $this->faker->randomElement(['0', '1']),
        'student_id' => "1",
        ];
    }
}
