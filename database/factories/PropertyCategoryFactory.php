<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyCategory>
 */
class PropertyCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement(['Villa', 'Apartment', 'Loft', 'Guest House', 'Studio', 'Penthouse', 'Cottage', 'Cabin', 'Bungalow', 'Mansion']);

        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name).'-'.$this->faker->unique()->numberBetween(1, 1000),
        ];
    }
}
