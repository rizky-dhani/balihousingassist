<?php

use App\Models\Property;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays site logo in header and footer', function () {
    $settings = SiteSetting::getSingleton();
    $settings->update(['logo' => 'site/logo.png']);

    $this->get('/')
        ->assertStatus(200)
        ->assertSee('storage/site/logo.png');
});

it('uses whatsapp number from site settings in property cards', function () {
    $settings = SiteSetting::getSingleton();
    $settings->whatsapp_number = '628999999999';
    $settings->save();

    // dd(SiteSetting::all()->toArray());

    $property = Property::factory()->create([
        'name' => 'Villa Dynamic WA',
        'is_available' => true,
    ]);

    $this->get('/')
        ->assertStatus(200)
        ->assertSee('628999999999')
        ->assertSee('interested+in+booking+Villa+Dynamic+WA');
});

it('uses fallback logo and wa number if not set', function () {
    // Ensure no settings exist
    SiteSetting::query()->delete();

    $property = Property::factory()->create([
        'name' => 'Villa Fallback',
        'is_available' => true,
    ]);

    $this->get('/')
        ->assertStatus(200)
        ->assertSee('wa.me/628123456789')
        ->assertDontSee('storage/site/');
});
