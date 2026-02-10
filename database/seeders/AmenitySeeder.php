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
            Amenity::firstOrCreate([
                'name' => $amenity,
                'icon' => $this->getIconForAmenity($amenity),
            ]);
        }
    }

    private function getIconForAmenity(string $amenityName): string
    {
        return match ($amenityName) {
            'WiFi' => 'hugeicon-wifi',
            'Air Conditioning' => 'hugeicon-snowflake',
            'Heating' => 'hugeicon-sun',
            'Washing Machine' => 'hugeicon-washing-machine',
            'Dryer' => 'hugeicon-dryer',
            'TV' => 'hugeicon-tv',
            'Iron' => 'hugeicon-iron',
            'Hair Dryer' => 'hugeicon-hair-dryer',
            'Dedicated Workspace' => 'hugeicon-desk',
            'Kitchen' => 'hugeicon-kitchen',
            'Refrigerator' => 'hugeicon-fridge',
            'Microwave' => 'hugeicon-microwave',
            'Dishwasher' => 'hugeicon-dishwasher',
            'Stove' => 'hugeicon-stove',
            'Oven' => 'hugeicon-oven',
            'Coffee Maker' => 'hugeicon-coffee',
            'Cooking Basics' => 'hugeicon-cooking',
            'Dishes and Silverware' => 'hugeicon-silverware',
            'Free Parking' => 'hugeicon-parking',
            'Gym' => 'hugeicon-gym',
            'Swimming Pool' => 'hugeicon-pool',
            'Hot Tub' => 'hugeicon-jacuzzi',
            'EV Charger' => 'hugeicon-ev-charger',
            'Private Garden' => 'hugeicon-garden',
            'Patio or Balcony' => 'hugeicon-balcony',
            'Backyard' => 'hugeicon-backyard',
            'BBQ Grill' => 'hugeicon-bbq-grill',
            'Outdoor Furniture' => 'hugeicon-outdoor-furniture',
            'Beach Access' => 'hugeicon-beach',
            'Waterfront' => 'hugeicon-waterfront',
            'Smoke Alarm' => 'hugeicon-smoke-detector',
            'Carbon Monoxide Alarm' => 'hugeicon-carbon-monoxide',
            'Fire Extinguisher' => 'hugeicon-fire-extinguisher',
            'First Aid Kit' => 'hugeicon-first-aid-kit',
            'Breakfast Included' => 'hugeicon-breakfast',
            'Pet Friendly' => 'hugeicon-paw',
            'Self Check-in' => 'hugeicon-key',
            'Long-term Stays Allowed' => 'hugeicon-calendar',
            'Private Entrance' => 'hugeicon-door',
            'Crib' => 'hugeicon-crib',
            'High Chair' => 'hugeicon-high-chair',
            default => 'hugeicon-home', // Default icon if no specific match
        };
    }
}
