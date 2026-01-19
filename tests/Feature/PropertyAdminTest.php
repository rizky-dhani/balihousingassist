<?php

use App\Filament\Resources\Properties\Pages\CreateProperty;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
});

it('can create a property with images', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = \App\Models\PropertyCategory::create([
        'name' => 'Villa',
        'slug' => 'villa',
    ]);

    Livewire::test(CreateProperty::class)
        ->fill([
            'data.name' => 'Test Property',
            'data.property_category_id' => $category->id,
            'data.type' => 'Villa',
            'data.location' => 'Ubud',
            'data.is_available' => true,
            'data.images' => [
                'properties/image1.jpg',
                'properties/image2.jpg',
            ],
        ])
        ->call('create')
        ->assertHasNoErrors();

    $property = Property::where('name', 'Test Property')->first();

    expect($property->images)
        ->toBeArray()
        ->toHaveCount(2)
        ->toContain('properties/image1.jpg')
        ->toContain('properties/image2.jpg');

    expect($property->property_category_id)->toBe($category->id);
    expect($property->location)->toBe('Ubud');
});
