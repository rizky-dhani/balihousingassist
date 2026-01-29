<?php

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders property cards with flexbox classes for consistent button alignment', function () {
    Property::factory()->create([
        'name' => 'Short Name',
        'is_available' => true,
    ]);

    Livewire::test('properties.list-properties')
        ->assertStatus(200)
        ->assertSeeHtml('flex flex-col h-full rounded-lg p-4 shadow-sm border')
        ->assertSeeHtml('flex flex-col flex-grow mt-2')
        ->assertSeeHtml('mt-auto text-center')
        ->assertSeeHtml('class="pt-4"');
});
