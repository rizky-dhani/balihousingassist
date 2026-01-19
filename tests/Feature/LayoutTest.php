<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders header and footer on the homepage', function () {
    \App\Models\Navigation::create(['label' => 'About', 'url' => '/about', 'order' => 1]);
    \App\Models\Navigation::create(['label' => 'Careers', 'url' => '/careers', 'order' => 2]);

    $response = $this->get(route('home'));

    $response->assertStatus(200);

    // Assert header is present (using some unique text from x-header)
    $response->assertSee('About');
    $response->assertSee('Careers');

    // Assert footer is present (using some unique text from x-footer)
    $response->assertSee('Navigation');
    $response->assertSee('Properties');
    $response->assertSee('Helpful Links');
    $response->assertSee('Contact Us');
    $response->assertSee('FAQs');
});

it('displays property categories in the footer', function () {
    $category = \App\Models\PropertyCategory::create([
        'name' => 'Villa',
        'slug' => 'villa',
    ]);

    $response = $this->get(route('home'));

    $response->assertSee('Villa');
});

it('uses whatsapp number from site settings in the footer', function () {
    $settings = \App\Models\SiteSetting::getSingleton();
    $settings->update(['whatsapp_number' => '628123456789']);

    $response = $this->get(route('home'));

    $response->assertSee('https://wa.me/628123456789');
});
