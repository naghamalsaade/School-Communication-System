<?php

namespace Database\Factories;

use App\Models\ClassGroup;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    private static $user_id = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'father_name' => $this->faker->firstName,
        'mother_name' => $this->faker->firstNameFemale,
        'user_name' => $this->faker->unique()->name,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone' => $this->faker->phoneNumber,
        'user_id' => self::$user_id++,
        'class_group_id' => ClassGroup::all()->random()->id,
        ];
    }

}
