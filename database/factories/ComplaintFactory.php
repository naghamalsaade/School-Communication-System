<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
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
        'title' => $this->faker->name,
        'text' => $this->faker->sentences(3,true),
        'sender_id' => User::all()->random()->id,
        ];
    }
}
