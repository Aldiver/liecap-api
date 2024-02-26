<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    // protected $model = Vehicle::class;

    public function definition()
    {
        $plateNumber = strtoupper($this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomDigit() . $this->faker->randomDigit() . $this->faker->randomDigit());

        return [
            'owner' => $this->faker->name,
            'plate_number' => $plateNumber,
            'validity' => $this->faker->randomElement(['Registered', 'Expired', 'Guest']),
            'validity_date' => $this->faker->date(),
            'type' => $this->faker->randomElement(['Car', 'Sedan', 'SUV', 'Truck']),
        ];
    }
}
