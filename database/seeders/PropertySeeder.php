<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\PropertyCategory::factory()->count(5)->create();
        $locations = \App\Models\PropertyLocation::factory()->count(10)->create();

        \App\Models\Property::factory(20)->create([
            'property_category_id' => fn () => $categories->random()->id,
            'property_location_id' => fn () => $locations->random()->id,
        ]);
    }
}
