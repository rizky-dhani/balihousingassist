<?php

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders the property images correctly', function () {
    Storage::fake('public');

    $images = [
        'properties/image1.jpg',
        'properties/image2.jpg',
        'properties/image3.jpg',
        'properties/image4.jpg',
        'properties/image5.jpg',
    ];

    $property = Property::factory()->create([
        'images' => $images,
    ]);

    $test = Livewire::test('properties.show-property', ['property' => $property])
        ->assertStatus(200);

    foreach ($images as $image) {
        $test->assertSee(Storage::url($image));
    }

    $test->assertSee('+1');
});

it('renders a fallback image when no images are present', function () {
    $property = Property::factory()->create([
        'images' => null,
    ]);

    Livewire::test('properties.show-property', ['property' => $property])
        ->assertStatus(200)
        ->assertSee('https://images.unsplash.com/photo-1512917774080-9991f1c4c750');
});
