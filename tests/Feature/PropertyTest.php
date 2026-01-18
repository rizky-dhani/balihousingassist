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

it('can filter properties by type reactively', function () {
    Property::factory()->create(['name' => 'The Grand Villa', 'type' => 'Villa', 'is_available' => true]);
    Property::factory()->create(['name' => 'Modern Urban Loft', 'type' => 'Loft', 'is_available' => true]);

    Livewire::test('properties.list-properties')
        ->set('type', 'Villa')
        ->assertSee('The Grand Villa')
        ->assertDontSee('Modern Urban Loft');
});
