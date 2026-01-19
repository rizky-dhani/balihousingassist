<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            // Essentials
            'WiFi',
            'Air Conditioning',
            'Heating',
            'Washing Machine',
            'Dryer',
            'TV',
            'Iron',
            'Hair Dryer',
            'Dedicated Workspace',

            // Kitchen & Dining
            'Kitchen',
            'Refrigerator',
            'Microwave',
            'Dishwasher',
            'Stove',
            'Oven',
            'Coffee Maker',
            'Cooking Basics',
            'Dishes and Silverware',

            // Facilities & Parking
            'Free Parking',
            'Gym',
            'Swimming Pool',
            'Hot Tub',
            'EV Charger',

            // Outdoor
            'Private Garden',
            'Patio or Balcony',
            'Backyard',
            'BBQ Grill',
            'Outdoor Furniture',
            'Beach Access',
            'Waterfront',

            // Safety
            'Smoke Alarm',
            'Carbon Monoxide Alarm',
            'Fire Extinguisher',
            'First Aid Kit',

            // Services & Features
            'Breakfast Included',
            'Pet Friendly',
            'Self Check-in',
            'Long-term Stays Allowed',
            'Private Entrance',
            'Crib',
            'High Chair',
        ];

        foreach ($amenities as $amenity) {
            Amenity::firstOrCreate(['name' => $amenity]);
        }
    }
}
