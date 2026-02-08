<?php

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can view property listing component', function () {
    Property::factory()->count(5)->create(['is_available' => true]);

    Livewire::test('properties.list-properties')
        ->assertStatus(200)
        ->assertSee('Our Properties');
});

it('can view property detail component', function () {
    $property = Property::factory()->create(['is_available' => true]);

    Livewire::test('properties.show-property', ['property' => $property])
        ->assertStatus(200)
        ->assertSee($property->name);
});

it('displays updated property card fields', function () {
    $location = \App\Models\PropertyLocation::create(['name' => 'Seminyak']);
    $property = Property::factory()->create([
        'name' => 'Test Card Property',
        'property_location_id' => $location->id,
        'bedroom' => 3,
        'bathroom' => 2,
        'price_daily' => 1500000,
        'is_available' => true,
    ]);

    Livewire::test('properties.list-properties')
        ->assertSee('Test Card Property')
        ->assertSee('Seminyak')
        ->assertSee('Bed')
        ->assertSee('Bath')
        ->assertSee('IDR 1,500,000')
        ->assertSee('/ night');
});

it('can filter properties by category manually', function () {
    $category = \App\Models\PropertyCategory::create(['name' => 'Villa', 'slug' => 'villa']);
    Property::factory()->create(['name' => 'The Grand Villa', 'property_category_id' => $category->id, 'is_available' => true]);
    Property::factory()->create(['name' => 'Modern Urban Loft', 'property_category_id' => null, 'is_available' => true]);

    Livewire::test('properties.list-properties')
        ->set('category', $category->slug)
        ->call('applyFilters')
        ->assertSee('The Grand Villa')
        ->assertDontSee('Modern Urban Loft')
        ->assertSee('Book Now');
});

it('can filter properties by location manually', function () {
    $canggu = \App\Models\PropertyLocation::create(['name' => 'Canggu']);
    $ubud = \App\Models\PropertyLocation::create(['name' => 'Ubud']);
    Property::factory()->create(['name' => 'Canggu Villa', 'property_location_id' => $canggu->id, 'is_available' => true]);
    Property::factory()->create(['name' => 'Ubud Villa', 'property_location_id' => $ubud->id, 'is_available' => true]);

    Livewire::test('properties.list-properties')
        ->set('property_location_id', $canggu->id)
        ->call('applyFilters')
        ->assertSee('Canggu Villa')
        ->assertDontSee('Ubud Villa');
});

it('automatically generates a slug when creating a property', function () {
    $property = Property::create([
        'name' => 'Beautiful Beach Villa',
        'is_available' => true,
    ]);

    expect($property->slug)->toBe('beautiful-beach-villa');
});

it('automatically updates the slug when the name changes', function () {
    $property = Property::create([
        'name' => 'Old Name Villa',
        'type' => 'Villa',
        'location' => 'Bali',
        'is_available' => true,
    ]);

    expect($property->slug)->toBe('old-name-villa');

    $property->update(['name' => 'New Awesome Villa']);

    expect($property->slug)->toBe('new-awesome-villa');
});

it('can load more properties using infinite scroll', function () {
    Property::factory()->count(15)->create(['is_available' => true]);

    Livewire::test('properties.list-properties')
        ->assertViewHas('properties', function ($properties) {
            return $properties->count() === 9;
        })
        ->call('loadMore')
        ->assertViewHas('properties', function ($properties) {
            return $properties->count() === 15;
        });
});

it('resets perPage when filters are applied', function () {
    Property::factory()->count(20)->create(['is_available' => true]);

    Livewire::test('properties.list-properties')
        ->call('loadMore')
        ->assertSet('perPage', 18)
        ->set('bedroom', 1)
        ->call('applyFilters')
        ->assertSet('perPage', 9);
});
