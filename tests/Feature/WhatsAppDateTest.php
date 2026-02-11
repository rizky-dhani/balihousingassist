<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhatsAppDateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_formats_dates_correctly_in_whatsapp_message()
    {
        // Create a site setting with a WhatsApp number
        $siteSetting = SiteSetting::create([
            'site_name' => 'Test Site',
            'whatsapp_number' => '628123456789',
        ]);

        // Create a property
        $property = Property::factory()->create([
            'name' => 'Test Property',
            'slug' => 'test-property',
            'description' => 'Test Description',
            'price_daily' => 100000,
        ]);

        // Test the component with dates in the same year
        $instance = app(\App\Livewire\Properties\ShowProperty::class);
        $instance->mount($property);
        $instance->checkInDate = '2023-06-15';
        $instance->checkOutDate = '2023-06-20';

        $viewData = $instance->render()->getData();
        $waUrl = $viewData['waUrl'];

        // Decode the URL to check the actual message content
        $decodedUrl = urldecode($waUrl);

        // Check that the URL contains the properly formatted dates
        $this->assertStringContainsString('Jun 15', $decodedUrl); // Check-in date without year (same year)
        $this->assertStringContainsString('Jun 20 2023', $decodedUrl); // Check-out date with year (same year)
        $this->assertStringContainsString('for this date: Jun 15 to Jun 20 2023', $decodedUrl); // New message format
        $this->assertStringNotContainsString('Jun 15 2023', $decodedUrl); // Check-in date should not have year when same year

        // Test with dates in different years
        $instance2 = app(\App\Livewire\Properties\ShowProperty::class);
        $instance2->mount($property);
        $instance2->checkInDate = '2023-12-30';
        $instance2->checkOutDate = '2024-01-05';

        $viewData2 = $instance2->render()->getData();
        $waUrl2 = $viewData2['waUrl'];

        // Decode the URL to check the actual message content
        $decodedUrl2 = urldecode($waUrl2);

        // Check that the URL contains the properly formatted dates with years
        $this->assertStringContainsString('Dec 30 2023', $decodedUrl2); // Check-in date with year
        $this->assertStringContainsString('Jan 5 2024', $decodedUrl2); // Check-out date with year (different year)
        $this->assertStringContainsString('for this date: Dec 30 2023 to Jan 5 2024', $decodedUrl2); // New message format
    }

    public function test_it_formats_single_checkin_date_correctly()
    {
        // Create a site setting with a WhatsApp number
        $siteSetting = SiteSetting::create([
            'site_name' => 'Test Site',
            'whatsapp_number' => '628123456789',
        ]);

        // Create a property
        $property = Property::factory()->create([
            'name' => 'Test Property',
            'slug' => 'test-property',
            'description' => 'Test Description',
            'price_daily' => 100000,
        ]);

        // Test the component with only check-in date
        $instance = app(\App\Livewire\Properties\ShowProperty::class);
        $instance->mount($property);
        $instance->checkInDate = '2023-06-15';

        $viewData = $instance->render()->getData();
        $waUrl = $viewData['waUrl'];

        // Decode the URL to check the actual message content
        $decodedUrl = urldecode($waUrl);

        // Check that the URL contains the properly formatted check-in date
        $this->assertStringContainsString('for check-in: Jun 15 2023', $decodedUrl); // Check-in date with year (when only check-in is provided)
    }
}
