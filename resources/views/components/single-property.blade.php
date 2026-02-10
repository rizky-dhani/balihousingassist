@props(['property'])

<div class="group flex flex-col h-full rounded-3xl overflow-hidden border border-base-200 bg-base-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
  <div class="relative aspect-4/3 overflow-hidden">
    <a href="{{ route('properties.show', $property->slug) }}" wire:navigate class="block h-full">
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
        class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
      />
      <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    </a>
    
    @if($property->category)
        <div class="absolute top-4 left-4">
            <span class="badge badge-primary font-bold shadow-lg">{{ $property->category->name }}</span>
        </div>
    @endif
  </div>

  <div class="flex flex-col flex-grow p-5">
    <div class="flex items-center gap-1 text-base-content/50 mb-2">
        <x-hugeicons-location-01 class="h-3.5 w-3.5" />
        <span class="text-xs font-bold uppercase tracking-wider">{{ $property->location?->city ?? 'Bali' }}</span>
    </div>

    <a href="{{ route('properties.show', $property->slug) }}" wire:navigate>
      <h3 class="font-bold text-xl mb-3 group-hover:text-primary transition-colors line-clamp-1">{{ $property->name }}</h3>
    </a>

    <div class="flex items-center gap-4 text-base-content/70 mb-6">
        <div class="flex items-center gap-1.5">
            <x-hugeicons-bed-double class="h-5 w-5 text-base-content/40" />
            <span class="text-sm font-bold">{{ $property->bedroom }}</span>
        </div>
        <div class="flex items-center gap-1.5">
            <x-hugeicons-bathtub-01 class="h-5 w-5 text-base-content/40" />
            <span class="text-sm font-bold">{{ (float) $property->bathroom }}</span>
        </div>
        <div class="flex items-center gap-1.5 ml-auto">
            <span class="badge badge-ghost badge-sm font-bold">{{ $property->is_available ? 'Available' : 'Booked' }}</span>
        </div>
    </div>

    <div class="mt-auto border-t border-base-200 pt-5 flex items-center justify-between">
        <div>
            @if($property->price_daily)
                <div class="flex flex-col">
                    <span class="text-[10px] uppercase font-bold text-base-content/40 tracking-widest leading-none mb-1">Daily from</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-lg font-extrabold text-primary">IDR {{ number_format($property->price_daily / 1000) }}k</span>
                        <span class="text-[10px] text-base-content/50 font-bold uppercase">/ night</span>
                    </div>
                </div>
            @elseif($property->price_monthly)
                <div class="flex flex-col">
                    <span class="text-[10px] uppercase font-bold text-base-content/40 tracking-widest leading-none mb-1">Monthly from</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-lg font-extrabold text-primary">IDR {{ number_format($property->price_monthly / 1000000, 1) }}M</span>
                        <span class="text-[10px] text-base-content/50 font-bold uppercase">/ month</span>
                    </div>
                </div>
            @else
                <span class="text-sm font-bold text-base-content/40 uppercase tracking-widest">Contact for Price</span>
            @endif
        </div>

        @php
            $siteSettings = \App\Models\SiteSetting::getSingleton();
            $waNumber = $siteSettings->whatsapp_number ?? '628123456789';
            $locationName = $property->location?->city ?? 'Bali';
            $waText = urlencode("Hello, I'm interested in booking " . $property->name . " in " . $locationName . ". Can I get more details?");
            $waUrl = "https://wa.me/{$waNumber}?text={$waText}";
        @endphp
        <a href="{{ $waUrl }}" target="_blank" class="btn btn-circle btn-primary btn-sm shadow-md shadow-primary/30">
            <x-hugeicons-whatsapp class="h-4 w-4" />
        </a>
    </div>
  </div>
</div>