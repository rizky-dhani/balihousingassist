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
    <div class="flex items-center justify-between mb-1">
      <span class="badge badge-primary badge-sm uppercase font-bold">{{ $property->type }}</span>
      <p class="text-xs text-base-content/60">{{ $property->location }}</p>
    </div>

    <a href="{{ route('properties.show', $property->slug) }}" wire:navigate>
      <h3 class="font-bold text-lg hover:text-primary transition-colors">{{ $property->name }}</h3>
    </a>

    <div class="mt-2">
        <div class="flex flex-wrap gap-x-4 gap-y-1">
        @if($property->price_daily)
        <div>
            <p class="text-[10px] text-base-content/50 uppercase font-bold">Daily</p>
            <p class="text-md font-bold">IDR {{ number_format($property->price_daily) }}</p>
        </div>
        @endif
        @if($property->price_monthly)
        <div>
            <p class="text-[10px] text-base-content/50 uppercase font-bold">Monthly</p>
            <p class="text-md font-bold">IDR {{ number_format($property->price_monthly) }}</p>
        </div>
        @endif
        </div>
    </div>

    <div class="mt-4">
        @php
            $waNumber = $siteSettings?->whatsapp_number ?? '628123456789';
            $waText = urlencode("Hello, I'm interested in booking " . $property->name . " in " . $property->location . ". Can I get more details?");
            $waUrl = "https://wa.me/{$waNumber}?text={$waText}";
        @endphp
        <a href="{{ $waUrl }}" target="_blank" class="btn btn-primary btn-sm w-full font-bold">
        <x-hugeicons-whatsapp class="h-4 w-4 mr-1" />
        Book Now
        </a>
    </div>
    </div>
</div>

    