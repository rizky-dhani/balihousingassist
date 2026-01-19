<?php

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can view property listing component', function () {
    Property::factory()->count(5)->create(['is_available' => true]);

    Livewire::test('properties.list-properties')
        ->assertStatus(200)
        ->assertSee('Our Property Catalog');
});

it('can view property detail component', function () {
    $property = Property::factory()->create(['is_available' => true]);

    Livewire::test('properties.show-property', ['property' => $property])
        ->assertStatus(200)
        ->assertSee($property->name)
        ->assertSee($property->type);
});

it('displays updated property card fields', function () {
    $property = Property::factory()->create([
        'name' => 'Test Card Property',
        'location' => 'Seminyak',
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
        ->set('category_id', $category->id)
        ->call('applyFilters')
        ->assertSee('The Grand Villa')
        ->assertDontSee('Modern Urban Loft')
        ->assertSee('Book Now');
});

it('can filter properties by location manually', function () {
    Property::factory()->create(['name' => 'Canggu Villa', 'location' => 'Canggu', 'is_available' => true]);
    Property::factory()->create(['name' => 'Ubud Villa', 'location' => 'Ubud', 'is_available' => true]);

    Livewire::test('properties.list-properties')
        ->set('location', 'Canggu')
        ->call('applyFilters')
        ->assertSee('Canggu Villa')
        ->assertDontSee('Ubud Villa');
});

it('automatically generates a slug when creating a property', function () {
    $property = Property::create([
        'name' => 'Beautiful Beach Villa',
        'type' => 'Villa',
        'location' => 'Bali',
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
