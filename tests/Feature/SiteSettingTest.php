<?php

use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSiteSettings;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
});

it('redirects list page to edit page of singleton', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(ListSiteSettings::class)
        ->assertRedirect();

    $this->assertDatabaseHas('site_settings', ['id' => 1]);
});

it('can update site settings', function () {
    $this->actingAs(User::factory()->create());
    $setting = SiteSetting::getSingleton();

    Livewire::test(EditSiteSetting::class, [
        'record' => $setting->getRouteKey(),
    ])
        ->fill([
            'data.facebook_url' => 'https://facebook.com/test',
            'data.twitter_url' => 'https://twitter.com/test',
            'data.settings' => [
                'phone' => '+628123456789',
            ],
        ])
        ->call('save')
        ->assertHasNoErrors();

    $setting->refresh();
    expect($setting->facebook_url)->toBe('https://facebook.com/test')
        ->and($setting->twitter_url)->toBe('https://twitter.com/test')
        ->and($setting->settings)->toBe(['phone' => '+628123456789']);
});
