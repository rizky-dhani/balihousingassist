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

    Livewire::test(CreateProperty::class)
        ->fill([
            'data.name' => 'Test Property',
            'data.slug' => 'test-property',
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

    $property = Property::where('slug', 'test-property')->first();

    expect($property->images)
        ->toBeArray()
        ->toHaveCount(2)
        ->toContain('properties/image1.jpg')
        ->toContain('properties/image2.jpg');
});
