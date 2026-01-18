<?php

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can view property listing page', function () {
    Property::factory()->count(5)->create(['is_available' => true]);

    $response = $this->get(route('properties.index'));

    $response->assertStatus(200);
    $response->assertSee('Our Property Catalog');
});

it('can view property detail page', function () {
    $property = Property::factory()->create(['is_available' => true]);

    $response = $this->get(route('properties.show', $property->slug));

    $response->assertStatus(200);
    $response->assertSee($property->name);
    $response->assertSee($property->type);
});

it('can filter properties by type', function () {
    Property::factory()->create(['name' => 'The Grand Villa', 'type' => 'Villa', 'is_available' => true]);
    Property::factory()->create(['name' => 'Modern Urban Loft', 'type' => 'Loft', 'is_available' => true]);

    $response = $this->get(route('properties.index', ['type' => 'Villa']));

    $response->assertStatus(200);
    $response->assertSee('The Grand Villa');
    $response->assertDontSee('Modern Urban Loft');
});
