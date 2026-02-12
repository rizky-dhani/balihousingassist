<?php

namespace App\Livewire\Properties;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;
use RalphJSmit\Laravel\SEO\TagManager;

#[Layout('layouts.app')]
class ShowProperty extends Component
{
    public Property $property;

    public $checkInDate = null;

    public $checkOutDate = null;

    public function mount(Property $property)
    {
        $this->property = $property->load(['amenities', 'seo']);
        $this->property->display_name = $this->property->category?->name . ' in ' . ($this->property->location?->city ?? 'Bali');
    }

    public function render()
    {
        app(TagManager::class)->for($this->property);

        // Prepare WhatsApp URL with date information if available
        $siteSettings = \App\Models\SiteSetting::getSingleton();
        $waNumber = preg_replace('/[^0-9]/', '', $siteSettings->whatsapp_number ?? '628123456789');

        $datesInfo = '';
        $checkInFormatted = '';
        $checkOutFormatted = '';

        if ($this->checkInDate && $this->checkOutDate) {
            // Format dates in M d Y format
            $checkInFormatted = \Carbon\Carbon::parse($this->checkInDate)->format('M j Y');
            $checkOutFormatted = \Carbon\Carbon::parse($this->checkOutDate)->format('M j Y');

            // Extract years to compare
            $checkInYear = \Carbon\Carbon::parse($this->checkInDate)->year;
            $checkOutYear = \Carbon\Carbon::parse($this->checkOutDate)->year;

            // Show year only on checkout date if check-in and checkout dates are within same year
            if ($checkInYear === $checkOutYear) {
                $checkInFormatted = \Carbon\Carbon::parse($this->checkInDate)->format('M j');
                $checkOutFormatted = \Carbon\Carbon::parse($this->checkOutDate)->format('M j Y'); // Year visible on checkout
            } else {
                // For different years, both should show the year
                $checkInFormatted = \Carbon\Carbon::parse($this->checkInDate)->format('M j Y');
                $checkOutFormatted = \Carbon\Carbon::parse($this->checkOutDate)->format('M j Y');
            }

            $propertyUrl = route('properties.show', $this->property->slug);
            $locationName = $this->property->location?->city ?? 'Bali';
            $waText = urlencode("Hello, I'm interested in booking this property in {$locationName}: {$propertyUrl}. Is it available for this date: {$checkInFormatted} to {$checkOutFormatted}?");
        } elseif ($this->checkInDate) {
            $checkInFormattedSingle = \Carbon\Carbon::parse($this->checkInDate)->format('M j Y');
            $propertyUrl = route('properties.show', $this->property->slug);
            $locationName = $this->property->location?->city ?? 'Bali';
            $waText = urlencode("Hello, I'm interested in booking this property in {$locationName}: {$propertyUrl}. Is it available for check-in: {$checkInFormattedSingle}?");
        } else {
            $propertyUrl = route('properties.show', $this->property->slug);
            $locationName = $this->property->location?->city ?? 'Bali';
            $waText = urlencode("Hello, I'm interested in booking this property in {$locationName}: {$propertyUrl}. Is it available?");
        }
        $waUrl = "https://wa.me/{$waNumber}?text={$waText}";

        return view('livewire.properties.show-property', [
            'schema' => $this->property->generateSchema(),
            'waUrl' => $waUrl,
        ]);
    }
}
