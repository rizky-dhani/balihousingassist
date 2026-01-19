<?php

namespace Database\Factories;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->company().' '.$this->faker->randomElement(['Villa', 'Guest House', 'Loft']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(3, true),
            'property_category_id' => \App\Models\PropertyCategory::factory(),
            'property_location_id' => \App\Models\PropertyLocation::factory(),
            'bedroom' => $this->faker->numberBetween(1, 6),
            'bathroom' => $this->faker->randomElement([1, 1.5, 2, 2.5, 3, 3.5, 4]),
            'price_daily' => $this->faker->numberBetween(500000, 5000000), // In IDR
            'price_weekly' => $this->faker->numberBetween(3000000, 30000000),
            'price_monthly' => $this->faker->numberBetween(10000000, 100000000),
            'price_yearly' => $this->faker->numberBetween(100000000, 1000000000),
            'is_available' => true,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Property $property) {
            $amenities = Amenity::all();

            if ($amenities->isNotEmpty()) {
                $property->amenities()->attach(
                    $amenities->random(rand(2, 5))->pluck('id')->toArray()
                );
            }
        });
    }
}
