<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntryRecord>
 */
class EntryRecordFactory extends Factory
{
    // protected $model = EntryRecord::class;
    
    public function definition()
    {
        $plateNumber = strtoupper($this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomDigit() . $this->faker->randomDigit() . $this->faker->randomDigit());

        return [
            'timestamp' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'vehicle_plate_number' => $plateNumber,
            'date' => $this->faker->date(),
        ];
    }
}
