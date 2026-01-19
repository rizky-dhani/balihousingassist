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
            'WiFi',
            'Swimming Pool',
            'Kitchen',
            'Air Conditioning',
            'Washing Machine',
            'TV',
            'Dedicated Workspace',
            'Free Parking',
            'Gym',
            'Private Garden',
            'Breakfast Included',
            'Pet Friendly',
        ];

        foreach ($amenities as $amenity) {
            Amenity::firstOrCreate(['name' => $amenity]);
        }
    }
}
