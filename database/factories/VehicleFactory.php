<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plate' => $this->faker->toUpper($this->faker->bothify('???####')),
            'model' => $this->faker->lastName(),
            'year' => $this->faker->year(),
            'color' => $this->faker->colorName(),
            'renavam' => $this->faker->bothify('#########'),
            'description' => $this->faker->text(10),
            'tracker_number' => $this->faker->unique()->bothify('#########'),
            'status' => 'available',
        ];
    }
}
