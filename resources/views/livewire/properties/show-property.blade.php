<section class="bg-base-100 pb-24 lg:pb-12" x-data="{ showSticky: false }">
    @if(isset($schema))
        @push('schema')
            <script type="application/ld+json">
                {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
            </script>
        @endpush
    @endif

    {{-- Hero Header Area --}}
    <div class="px-4 lg:px-8 pt-8 pb-4 max-w-screen-xl mx-auto">
        <nav class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-6 flex items-center gap-2">
            <a href="{{ route('home') }}" wire:navigate class="hover:text-primary transition-colors">Home</a>
            <span class="opacity-30">/</span>
            <a href="{{ route('properties.index') }}" wire:navigate class="hover:text-primary transition-colors">Properties</a>
            @if($property->category)
                <span class="opacity-30">/</span>
                <a href="{{ route('properties.index', ['category' => $property->category->slug]) }}" wire:navigate class="hover:text-primary transition-colors">{{ $property->category->name }}</a>
            @endif
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    @if($property->category)
                        <span class="badge badge-primary font-bold">{{ $property->category->name }}</span>
                    @endif
                    <span class="flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-base-content/60 bg-base-200 px-3 py-1 rounded-full">
                        <x-hugeicons-location-01 class="size-3" />
                        {{ $property->location?->city ?? 'Bali' }}
                    </span>
                </div>
                <h1 class="text-3xl lg:text-5xl font-black tracking-tight leading-tight">{{ $property->name }}</h1>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="btn btn-circle btn-outline btn-sm border-base-300 hover:bg-base-200 hover:text-base-content hover:border-base-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /></svg>
                </button>
                <button class="btn btn-circle btn-outline btn-sm border-base-300 hover:bg-base-200 hover:text-base-content hover:border-base-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="max-w-screen-xl mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        {{-- Left Column: Details --}}
        <div class="lg:col-span-8">
            <div class="mb-12">
                <x-property-gallery :images="$property->images" :name="$property->name" :mainImage="$property->main_image" />
            </div>

            <div class="flex items-center gap-8 py-6 border-y border-base-200 mb-12 overflow-x-auto no-scrollbar">
                <div class="flex items-center gap-3">
                    <div class="size-12 rounded-2xl bg-base-200 flex items-center justify-center">
                        <x-hugeicons-bed-double class="size-6 text-primary" />
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-tighter text-base-content/40 leading-none mb-1">Bedrooms</p>
                        <p class="text-lg font-black leading-none">{{ $property->bedroom }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="size-12 rounded-2xl bg-base-200 flex items-center justify-center">
                        <x-hugeicons-bathtub-01 class="size-6 text-primary" />
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-tighter text-base-content/40 leading-none mb-1">Bathrooms</p>
                        <p class="text-lg font-black leading-none">{{ (float) $property->bathroom }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="size-12 rounded-2xl bg-base-200 flex items-center justify-center">
                        <x-hugeicons-checkmark-circle-01 class="size-6 text-primary" />
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-tighter text-base-content/40 leading-none mb-1">Status</p>
                        <p class="text-lg font-black leading-none">{{ $property->is_available ? 'Available' : 'Booked' }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-2xl font-black mb-6">About this sanctuary</h2>
                <div class="text-lg text-base-content/80 leading-relaxed whitespace-pre-line prose max-w-none">
                    {{ $property->description }}
                </div>
            </div>

                            @if($property->amenities->count() > 0)
                                <div class="mb-16">
                                    <h2 class="text-2xl font-black mb-8">Amenities</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">                        @foreach($property->amenities as $amenity)
                            <div class="flex items-center gap-4 p-4 rounded-2xl border border-base-200 bg-base-100 group hover:border-primary transition-colors">
                                <div class="size-10 rounded-xl bg-base-200 flex items-center justify-center text-primary transition-colors">
                                    <x-hugeicons-checkmark-circle-01 class="size-5" />
                                </div>
                                <span class="font-bold text-sm leading-tight">{{ $amenity->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mb-16 pt-12 border-t border-base-200">
                <h2 class="text-2xl font-black mb-8">Where you'll be</h2>
                <div class="relative rounded-3xl overflow-hidden h-[450px] bg-base-200 shadow-inner group">
                    @if($property->latitude && $property->longitude)
                        <div class="h-full w-full" id="map"></div>
                        <div class="absolute bottom-4 left-4 z-[1000]">
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $property->latitude }},{{ $property->longitude }}" target="_blank" class="btn btn-neutral btn-sm rounded-full shadow-lg gap-2">
                                <x-hugeicons-location-01 class="size-4" />
                                Open in Google Maps
                            </a>
                        </div>
                    @else
                        <div class="h-full w-full flex flex-col items-center justify-center text-base-content/20 border-2 border-dashed border-base-300 rounded-3xl">
                            <x-hugeicons-location-01 class="size-20 mb-4 opacity-10" />
                            <p class="text-2xl font-black">Coordinates not available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column: Booking Card (Sticky) --}}
        <div class="lg:col-span-4">
            <div class="lg:sticky lg:top-24 mb-12">
                <div class="bg-base-100 rounded-3xl border border-base-200 shadow-2xl p-8">
                    <h3 class="text-sm font-black uppercase tracking-widest text-base-content/30 mb-6">Reservation Details</h3>
                    
                    <div class="space-y-4 mb-8">
                        @if($property->price_daily)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-base-200/50 border border-transparent hover:border-primary/20 transition-all">
                                <span class="font-bold text-sm">Daily Rate</span>
                                <span class="text-lg font-black text-primary">IDR {{ number_format($property->price_daily) }}</span>
                            </div>
                        @endif
                        @if($property->price_monthly)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-base-200/50 border border-transparent hover:border-primary/20 transition-all">
                                <span class="font-bold text-sm">Monthly Rate</span>
                                <span class="text-lg font-black text-primary">IDR {{ number_format($property->price_monthly) }}</span>
                            </div>
                        @endif
                        @if($property->price_yearly)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-base-200/50 border border-transparent hover:border-primary/20 transition-all">
                                <span class="font-bold text-sm">Yearly Rate</span>
                                <span class="text-lg font-black text-primary">IDR {{ number_format($property->price_yearly) }}</span>
                            </div>
                        @endif
                        
                        @if(!$property->price_daily && !$property->price_monthly && !$property->price_yearly)
                            <div class="p-6 rounded-2xl bg-primary/5 border border-primary/20 text-center">
                                <p class="font-black text-primary">Price upon request</p>
                                <p class="text-xs text-base-content/50 mt-1">Contact us for a personalized quote</p>
                            </div>
                        @endif
                    </div>

                    <div class="bg-neutral text-neutral-content p-6 rounded-2xl mb-8">
                        <div class="flex items-start gap-4">
                            <div class="size-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                <x-hugeicons-whatsapp class="size-6" />
                            </div>
                            <div>
                                <p class="font-black text-sm mb-1">Direct Booking</p>
                                <p class="text-xs opacity-70 leading-relaxed">Secure your stay instantly via WhatsApp. No hidden platform fees.</p>
                            </div>
                        </div>
                    </div>

                    @php
                        $siteSettings = \App\Models\SiteSetting::getSingleton();
                        $waNumber = $siteSettings->whatsapp_number ?? '628123456789';
                        $waText = urlencode("Hello, I'm interested in booking " . $property->name . " in " . ($property->location?->city ?? 'Bali') . ". Is it available for my dates?");
                        $waUrl = "https://wa.me/{$waNumber}?text={$waText}";
                    @endphp
                    
                    <a 
                        href="{{ $waUrl }}"
                        target="_blank"
                        x-intersect:enter="showSticky = false"
                        x-intersect:leave="showSticky = $el.getBoundingClientRect().top < 0"
                        class="btn btn-primary btn-lg w-full rounded-2xl font-black h-16 shadow-xl shadow-primary/20 hover:scale-[1.02] transition-transform"
                    >
                        Confirm Reservation
                    </a>
                    
                    <p class="text-center text-[10px] text-base-content/40 mt-4 uppercase font-bold tracking-widest">Powered by {{ config('app.name') }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($property->latitude && $property->longitude)
        <script>
            document.addEventListener('livewire:initialized', () => {
                const map = L.map('map', {
                    scrollWheelZoom: false,
                    zoomControl: false
                }).setView([{{ $property->latitude }}, {{ $property->longitude }}], 15);
                
                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.control.zoom({ position: 'topright' }).addTo(map);

                const markerIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: '<div class="size-8 bg-primary rounded-full border-4 border-white shadow-xl flex items-center justify-center text-white"><svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 21l-1.41-1.41L5 14.17C3.14 12.31 2 9.77 2 7a7 7 0 0114 0c0 2.77-1.14 5.31-3 7.17l-5.59 5.42L12 21z" /></svg></div>',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32]
                });

                L.marker([{{ $property->latitude }}, {{ $property->longitude }}], { icon: markerIcon }).addTo(map);
            });
        </script>
        <style>
            .leaflet-container { font-family: inherit; }
        </style>
    @endif

    {{-- Sticky Book Now for Mobile --}}
    <div 
        x-show="showSticky"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="lg:hidden fixed bottom-0 left-0 right-0 bg-base-100/90 backdrop-blur-xl border-t border-base-200 p-6 pb-8 z-50 shadow-[0_-10px_25px_-5px_rgba(0,0,0,0.1)]"
        x-cloak
    >
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-base-content/40 leading-none mb-1">Starting from</p>
                <p class="text-xl font-black text-primary">IDR {{ number_format($property->price_daily ?? $property->price_monthly ?? 0) }}</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-bold uppercase tracking-widest text-base-content/40 leading-none mb-1">Property</p>
                <p class="text-xs font-black truncate max-w-[150px]">{{ $property->name }}</p>
            </div>
        </div>
        <a href="{{ $waUrl }}" target="_blank" class="btn btn-primary w-full btn-lg rounded-2xl font-black shadow-xl shadow-primary/30 h-16">
            <x-hugeicons-whatsapp class="size-6" />
            Book Now
        </a>
    </div>
</section>
