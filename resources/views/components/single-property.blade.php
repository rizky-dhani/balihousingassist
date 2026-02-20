@props(['property'])

@php
    $displayName = $property->category?->name . ' in ' . ($property->location?->name ?? 'Bali');
    $thumbnail = 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80';
    if ($property->main_image) {
        $thumbnail = asset('storage/' . $property->main_image);
    } elseif ($property->images && count($property->images) > 0) {
        $thumbnail = asset('storage/' . $property->images[0]);
    }
    $siteSettings = \App\Models\SiteSetting::getSingleton();
    $waNumber = preg_replace('/[^0-9]/', '', $siteSettings->whatsapp_number ?? '628123456789');
    $locationName = $property->location?->name ?? 'Bali';
    $propertyUrl = route('properties.show', $property->slug);
    $waText = urlencode("Hello, I'm interested in booking this property in {$locationName}: {$propertyUrl}");
    $waUrl = "https://wa.me/{$waNumber}?text={$waText}";
@endphp

<div class="flex flex-col h-full rounded-3xl overflow-hidden bg-base-100">
    <div class="relative aspect-4/3 overflow-hidden rounded-3xl border border-base-200">
    <a href="{{ route('properties.show', $property->slug) }}" wire:navigate class="block h-full">
      <img
        alt="{{ $displayName }}"
        src="{{ $thumbnail }}"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
    </a>

    @if($property->is_featured)
        <div class="absolute top-4 left-4">
            <span class="badge badge-secondary font-bold shadow-lg">Featured</span>
        </div>
    @endif

    @if($property->category)
        <div class="absolute top-4 {{ $property->is_featured ? 'left-28' : 'left-4' }}">
            <span class="badge badge-primary font-bold shadow-lg">{{ $property->category->name }}</span>
        </div>
    @endif
  </div>

  <div class="flex flex-col flex-grow py-4">


    <a href="{{ route('properties.show', $property->slug) }}" wire:navigate>
      <h3 class="font-bold text-lg mb-2 transition-colors line-clamp-2">{{ $displayName }}</h3>
    </a>

    <div class="flex items-center gap-3 text-base-content/70 mb-4">
        <div class="flex items-center gap-1">
            <x-hugeicons-bed-double class="h-4 w-4 text-base-content/40" />
            <span class="text-xs font-bold">{{ $property->bedroom }}</span>
        </div>
        <div class="flex items-center gap-1">
            <x-hugeicons-bathtub-01 class="h-4 w-4 text-base-content/40" />
            <span class="text-xs font-bold">{{ (float) $property->bathroom }}</span>
        </div>

    </div>

    <div class="mt-auto border-t border-base-200 pt-4 flex items-center justify-between">
        <div>
            @if($property->price_daily)
                <div class="flex flex-col">
                    <span class="text-[9px] uppercase font-bold text-base-content/40 tracking-widest leading-none mb-1">Daily from</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-base font-extrabold text-primary">IDR {{ number_format($property->price_daily / 1000) }}k</span>
                        <span class="text-[9px] text-base-content/50 font-bold uppercase">/ night</span>
                    </div>
                </div>
            @elseif($property->price_monthly)
                <div class="flex flex-col">
                    <span class="text-[9px] uppercase font-bold text-base-content/40 tracking-widest leading-none mb-1">Monthly from</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-base font-extrabold text-primary">IDR {{ number_format($property->price_monthly / 1000000, 1) }}M</span>
                        <span class="text-[9px] text-base-content/50 font-bold uppercase">/ month</span>
                    </div>
                </div>
            @else
                <span class="text-xs font-bold text-base-content/40 uppercase tracking-widest">Contact for Price</span>
            @endif
        </div>


    </div>
  </div>
</div>