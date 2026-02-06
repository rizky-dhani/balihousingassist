<?php

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders SEO title and description for a property', function () {
    $property = Property::factory()->create([
        'name' => 'Paradise Villa',
        'description' => 'This is a beautiful villa in Bali.',
        'is_available' => true,
    ]);

    // We need to test the actual HTML output because Livewire::test doesn't render the layout's <head>
    $response = $this->get(route('properties.show', $property));

    if ($response->status() !== 200) {
        $response->dump();
    }

    $response->assertStatus(200)
        ->assertSee('<title>Paradise Villa', false)
        ->assertSee('<meta name="description" content="This is a beautiful villa in Bali."', false);
});

it('renders custom SEO overrides for a property', function () {
    $property = Property::factory()->create([
        'name' => 'Paradise Villa',
        'is_available' => true,
    ]);

    $property->seo->update([
        'title' => 'Custom SEO Title',
        'description' => 'Custom SEO Description',
    ]);

    $this->get(route('properties.show', $property))
        ->assertStatus(200)
        ->assertSee('<title>Custom SEO Title', false)
        ->assertSee('<meta name="description" content="Custom SEO Description"', false);
});

it('renders global SEO defaults on the home page', function () {
    $this->get(route('home'))
        ->assertStatus(200)
        ->assertSee('<meta property="og:site_name" content="Bali Housing Assist"', false);
});

it('renders JSON-LD schema for a property', function () {
    $property = Property::factory()->create([
        'name' => 'Paradise Villa',
        'is_available' => true,
    ]);

    $this->get(route('properties.show', $property))
        ->assertStatus(200)
        ->assertSee('application/ld+json', false)
        ->assertSee('"@type": "RealEstateListing"', false)
        ->assertSee('"name": "Paradise Villa"', false);
});
