<?php

namespace Database\Factories;

use App\Models\Treatment;
use App\Models\Customer; // Add this line
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => rand(10, 100),
            'version' => rand(1, 5),
            'customer_id' => Customer::factory(),
        ];
    }
}