@props(['property'])

<div class="block rounded-lg p-4 shadow-sm border border-base-200 bg-base-100 transition-all hover:shadow-lg">
  <a href="{{ route('properties.show', $property->slug) }}" wire:navigate>
    <img
      alt="{{ $property->name }}"
      src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80"
      class="h-56 w-full rounded-md object-cover transition duration-500 hover:scale-105"
    />
  </a>

  <div class="mt-2">
    <a href="{{ route('properties.show', $property->slug) }}" wire:navigate>
      <h3 class="font-bold text-lg hover:text-primary transition-colors mb-2">{{ $property->name }}</h3>
    </a>

    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 text-base-content/70">
            <div class="flex items-center gap-1">
                <x-hugeicons-bed-double class="h-4 w-4" />
                <span class="text-md font-medium">{{ $property->bedroom }} Bed</span>
            </div>
            <div class="flex items-center gap-1">
                <x-hugeicons-bathtub-01 class="h-4 w-4" />
                <span class="text-md font-medium">{{ $property->bathroom }} Bath</span>
            </div>
        </div>
        <div class="flex items-center gap-1">
            <x-hugeicons-location-01 class="h-4 w-4 text-primary" />
            <span class="text-md font-bold text-base-content">{{ $property->location }}</span>
        </div>
    </div>

    <div class="mt-2">
        @if($property->price_daily)
        <div class="flex items-baseline gap-1">
            <span class="text-lg font-bold text-primary">IDR {{ number_format($property->price_daily) }}</span>
            <span class="text-xs text-base-content/50">/ night</span>
        </div>
        @else
        <div class="flex items-baseline gap-1">
            <span class="text-lg font-bold text-primary">Ask</span>
        </div>
        @endif
    </div>

    <div class="mt-4">
        @php
            $siteSettings = \App\Models\SiteSetting::getSingleton();
            $waNumber = $siteSettings->whatsapp_number ?? '628123456789';
            $locationName = $property->location_details?->city ?? $property->location;
            $waText = urlencode("Hello, I'm interested in booking " . $property->name . " in " . $locationName . ". Can I get more details?");
            $waUrl = "https://wa.me/{$waNumber}?text={$waText}";
        @endphp
        <a href="{{ $waUrl }}" target="_blank" class="btn btn-primary btn-sm w-full font-bold">
        <x-hugeicons-whatsapp class="h-4 w-4 mr-1" />
        Book Now
        </a>
    </div>
    </div>
</div>

    