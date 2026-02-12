<?php

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('displays the share button with text and no wishlist button', function () {
    $property = Property::factory()->create();

    Livewire::test('properties.show-property', ['property' => $property])
        ->assertSee('Share')
        ->assertDontSee('M4.318 6.318'); // Heart icon path should be gone
});

it('includes the share functionality in x-data', function () {
    $property = Property::factory()->create();

    Livewire::test('properties.show-property', ['property' => $property])
        ->assertSee('share()')
        ->assertSee('copied: false');
});
