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
            'WiFi' => 'wifi',
            'Air Conditioning' => 'snow',
            'Heating' => 'sun',
            'Washing Machine' => 'washing-machine',
            'Dryer' => 'hanger',
            'TV' => 'tv',
            'Iron' => 'suit-01',
            'Hair Dryer' => 'hair-dryer',
            'Dedicated Workspace' => 'computer-desk-01',
            'Kitchen' => 'chef-hat',
            'Refrigerator' => 'fridge',
            'Microwave' => 'microwave',
            'Dishwasher' => 'dish-washer',
            'Stove' => 'gas-stove',
            'Oven' => 'oven',
            'Coffee Maker' => 'coffee-02',
            'Cooking Basics' => 'glove',
            'Dishes and Silverware' => 'kitchen-utensils',
            'Free Parking' => 'car-parking-02',
            'Gym' => 'equipment-bench-press',
            'Swimming Pool' => 'pool',
            'Hot Tub' => 'hot-tube',
            'EV Charger' => 'ev-charging',
            'Private Garden' => 'plant-02',
            'Patio or Balcony' => 'home-02',
            'Backyard' => 'football-pitch',
            'BBQ Grill' => 'bbq-grill',
            'Beach Access' => 'beach',
            'Waterfront' => 'water-polo',
            'Smoke Alarm' => 'alert-square',
            'Carbon Monoxide Alarm' => 'alert-circle',
            'Fire Extinguisher' => 'fire-security',
            'First Aid Kit' => 'first-aid-kit',
            'Breakfast Included' => 'vegetarian-food',
            'Pet Friendly' => 'skipping-rope',
            'Self Check-in' => 'key-01',
            'Long-term Stays Allowed' => 'calendar-01',
            'Private Entrance' => 'door',
            'Crib' => 'baby-bed-01',
            'High Chair' => 'chair-03',
            default => 'home', // Default icon if no specific match
        };
    }
}
