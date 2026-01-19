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

it('can filter properties by type reactively', function () {
    Property::factory()->create(['name' => 'The Grand Villa', 'type' => 'Villa', 'is_available' => true]);
    Property::factory()->create(['name' => 'Modern Urban Loft', 'type' => 'Loft', 'is_available' => true]);

    Livewire::test('properties.list-properties')
        ->set('type', 'Villa')
        ->assertSee('The Grand Villa')
        ->assertDontSee('Modern Urban Loft')
        ->assertSee('Book Now')
        ->assertSee('https://wa.me/628123456789');
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
