<?php

use App\Filament\Resources\Navigations\Pages\CreateNavigation;
use App\Models\Navigation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can create a navigation item', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(CreateNavigation::class)
        ->fill([
            'data.label' => 'Home',
            'data.url' => '/',
            'data.order' => 1,
            'data.new_tab' => false,
        ])
        ->call('create')
        ->assertHasNoErrors();

    $this->assertDatabaseHas(Navigation::class, [
        'label' => 'Home',
        'url' => '/',
        'order' => 1,
    ]);
});

it('can create a navigation item with parent', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $parent = Navigation::create([
        'label' => 'About',
        'url' => '/about',
    ]);

    Livewire::test(CreateNavigation::class)
        ->fill([
            'data.label' => 'Team',
            'data.url' => '/about/team',
            'data.parent_id' => $parent->id,
            'data.order' => 1,
        ])
        ->call('create')
        ->assertHasNoErrors();

    $this->assertDatabaseHas(Navigation::class, [
        'label' => 'Team',
        'parent_id' => $parent->id,
    ]);
});
