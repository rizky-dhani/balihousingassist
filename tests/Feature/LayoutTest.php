<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders header and footer on the homepage', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);

    // Assert header is present (using some unique text from x-header)
    $response->assertSee('About');
    $response->assertSee('Careers');

    // Assert footer is present (using some unique text from x-footer)
    $response->assertSee('Bali Housing Assist');
    $response->assertSee('Helpful Links');
});
