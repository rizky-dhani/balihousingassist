@props(['property'])

<div class="max-w-screen-xl mx-auto flex flex-col h-full rounded-lg p-4 shadow-sm border border-base-200 bg-base-100 transition-all hover:shadow-lg">
  <a href="{{ route('properties.show', $property->slug) }}" wire:navigate>
    @php
        $thumbnail = 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80';
        if ($property->main_image) {
            $thumbnail = asset('storage/' . $property->main_image);
        } elseif ($property->images && count($property->images) > 0) {
            $thumbnail = asset('storage/' . $property->images[0]);
        }
    @endphp
    <img
      alt="{{ $property->name }}"
      src="{{ $thumbnail }}"
      class="aspect-4/3 w-full rounded-md object-cover transition duration-500 hover:scale-105"
    />
  </a>

  <div class="flex flex-col flex-grow mt-2">
    @if($property->category)
        <span class="badge badge-secondary badge-outline badge-xs mb-1 uppercase font-bold">{{ $property->category->name }}</span>
    @endif
    <a href="{{ route('properties.show', $property->slug) }}" wire:navigate>
      <h3 class="font-bold text-lg hover:text-primary transition-colors">{{ $property->name }}</h3>
    </a>

    <div class="flex-grow flex items-center justify-center py-3 ">
        <div class="flex items-center gap-3 text-base-content/70">
            <div class="flex items-center gap-2">
                <x-hugeicons-bed-double class="h-5 w-5" />
                <span class="text-md font-medium text-base-content">{{ $property->bedroom }}</span>
            </div>
            <div class="flex items-center gap-2">
                <x-hugeicons-bathtub-01 class="h-5 w-5" />
                <span class="text-md font-medium text-base-content">{{ (float) $property->bathroom }}</span>
            </div>
            <div class="flex items-center gap-2">
                <x-hugeicons-location-01 class="h-5 w-5 text-primary" />
                <span class="text-md font-bold text-base-content">{{ $property->location?->city ?? 'Bali' }}</span>
            </div>
        </div>
    </div>

    <div class="mt-auto text-center">
        @if($property->price_daily)
            <div class="flex flex-col items-center">
                <span class="text-[10px] uppercase font-bold text-base-content/40 tracking-wider">Start From</span>
                <div class="flex items-baseline justify-center gap-1">
                    <span class="text-xl font-bold text-primary">IDR {{ number_format($property->price_daily) }}</span>
                    <span class="text-xs text-base-content/60">/ night</span>
                </div>
            </div>
        @elseif($property->price_monthly)
            <div class="flex flex-col items-center">
                <span class="text-[10px] uppercase font-bold text-base-content/40 tracking-wider">Start From</span>
                <div class="flex items-baseline justify-center gap-1">
                    <span class="text-xl font-bold text-primary">IDR {{ number_format($property->price_monthly) }}</span>
                    <span class="text-xs text-base-content/60">/ month</span>
                </div>
            </div>
        @else
            <div class="flex items-baseline justify-center gap-1">
                <span class="text-lg font-bold text-primary">Ask for Price</span>
            </div>
        @endif
    </div>

    <div class="pt-4">
        @php
            $siteSettings = \App\Models\SiteSetting::getSingleton();
            $waNumber = $siteSettings->whatsapp_number ?? '628123456789';
            $locationName = $property->location?->city ?? 'Bali';
            $waText = urlencode("Hello, I'm interested in booking " . $property->name . " in " . $locationName . ". Can I get more details?");
            $waUrl = "https://wa.me/{$waNumber}?text={$waText}";
        @endphp
        <a href="{{ $waUrl }}" target="_blank" class="btn btn-primary btn-sm w-full font-bold">
        <x-hugeicons-whatsapp class="h-4 w-4 mr-1" />
        <p class="text-md">Book Now</p>
        </a>
    </div>
    </div>
</div>