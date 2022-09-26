<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    use HasFactory;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'title' => $this->faker->name,
        'description' => $this->faker->sentences(3,true),
        ];
    }
}
