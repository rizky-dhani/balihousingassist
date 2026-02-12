<?php

namespace Database\Seeders;

use App\Models\PropertyCategory;
use Illuminate\Database\Seeder;

class UpdateCategoryIconsSeeder extends Seeder
{
    public function run(): void
    {
        $icons = [
            'Guest House' => 'hugeicons-home-02',
            'Apartment' => 'hugeicons-building-01',
            'Penthouse' => 'hugeicons-building-05',
            'Studio' => 'hugeicons-house-01',
            'Cottage' => 'hugeicons-home-01',
        ];

        foreach ($icons as $name => $icon) {
            PropertyCategory::where('name', $name)->update(['icon' => $icon]);
        }
    }
}
