<?php

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('displays amenities on property detail page', function () {
    $property = Property::factory()->create();
    $amenity = Amenity::create(['name' => 'Wifi']);
    $property->amenities()->attach($amenity);

    Livewire::test('properties.show-property', ['property' => $property])
        ->assertSee('Amenities')
        ->assertSee('Wifi');
});

it('does not display amenities section when property has no amenities', function () {
    $property = Property::factory()->create();

    Livewire::test('properties.show-property', ['property' => $property])
        ->assertDontSee('Amenities');
});
