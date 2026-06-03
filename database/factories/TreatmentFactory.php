<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentFactory extends Factory
{
    protected $model = Treatment::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'name'        => $this->faker->word(),
            'price'       => $this->faker->randomFloat(2, 10, 200),
            'version'     => $this->faker->randomDigitNotNull(),
        ];
    }
}