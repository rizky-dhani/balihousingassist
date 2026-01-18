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
            <p class="text-sm font-bold">IDR {{ number_format($property->price_daily) }}</p>
        </div>
        @endif
        @if($property->price_monthly)
        <div>
            <p class="text-[10px] text-base-content/50 uppercase font-bold">Monthly</p>
            <p class="text-sm font-bold">IDR {{ number_format($property->price_monthly) }}</p>
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
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.438 9.889-9.886.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 2.042-.534zm10.387-5.4c.271.135.451.203.54.339.09.135.09.787-.248 1.732-.338.945-1.982 1.845-2.727 1.89-.744.045-1.49-.135-4.725-1.485-3.237-1.35-5.321-4.635-5.479-4.86-.16-.225-1.264-1.687-1.264-3.217 0-1.53.788-2.283 1.07-2.576.282-.293.631-.36.835-.36.204 0 .406.001.587.007.191.007.45-.072.703.54.254.612.868 2.115.946 2.272.079.158.131.338.023.563-.109.225-.162.337-.319.517-.157.18-.33.4-.471.536-.158.158-.323.33-.139.612.184.282.815 1.341 1.742 2.167.927.826 1.71 1.081 2.048 1.238.338.158.54.135.744-.09.203-.225.868-.99 1.104-1.327.236-.338.474-.282.788-.169z"/></svg>
        Book Now
        </a>
    </div>
    </div>
</div>

    