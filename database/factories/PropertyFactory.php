<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company() . ' ' . $this->faker->randomElement(['Villa', 'Guest House', 'Loft']);
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'description' => $this->faker->paragraphs(3, true),
            'type' => $this->faker->randomElement(['Villa', 'Guest House', 'Loft']),
            'location' => $this->faker->randomElement(['Canggu', 'Seminyak', 'Ubud', 'Uluwatu', 'Pererenan']),
            'address' => $this->faker->address(),
            'price_daily' => $this->faker->numberBetween(500000, 5000000), // In IDR
            'price_weekly' => $this->faker->numberBetween(3000000, 30000000),
            'price_monthly' => $this->faker->numberBetween(10000000, 100000000),
            'price_yearly' => $this->faker->numberBetween(100000000, 1000000000),
            'is_available' => true,
        ];
    }
}
