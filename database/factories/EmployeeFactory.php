<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'contact_no' => $this->faker->shuffle,
            'designation' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'profile' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
            'department' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'job_type' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'email' => $this->faker->safeEmail(),
            'password' => $this->faker->password,
            'joining_date' => $this->faker->shuffle,
            'status' => $this->faker->shuffle,
            'attendance' => $this->faker->shuffle,

        ];
    }
}
