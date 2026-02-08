<?php

use App\Filament\Pages\Analytics;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

it('denies access to guests', function () {
    $this->get(Analytics::getUrl())->assertRedirect();
});

it('denies access to unauthorized users', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->get(Analytics::getUrl())->assertForbidden();
});

it('allows access to admins', function () {
    $user = User::factory()->create();
    Role::create(['name' => 'Super Admin']);
    $user->assignRole('Super Admin');

    $this->actingAs($user)->get(Analytics::getUrl())->assertSuccessful();
});
