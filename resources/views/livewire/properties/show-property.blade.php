@if(isset($schema))
    @push('schema')
        <script type="application/ld+json">
            {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endpush
@endif

<div x-data="{ showSticky: false }">
    <section class="bg-base-100 pt-8 pb-24 lg:py-12 px-4 lg:px-8">
        <div class="max-w-screen-xl mx-auto">
            {{-- Breadcrumbs --}}
            <nav class="text-sm breadcrumbs mb-8">
                <ul>
                    <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                    <li><a href="{{ route('properties.index') }}" wire:navigate>Properties</a></li>
                    @if($property->category)
                        <li><a href="{{ route('properties.index', ['category_id' => $property->category->id]) }}" wire:navigate>{{ $property->category->name }}</a></li>
                    @endif
                    <li class="font-bold text-primary">{{ $property->name }}</li>
                </ul>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">
                <x-property-gallery :images="$property->images" :name="$property->name" />

                <div class="flex flex-col">
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            @if($property->category)
                                <span class="badge badge-primary">{{ $property->category->name }}</span>
                            @endif
                            <span class="badge badge-ghost text-base-content/60">{{ $property->location?->city ?? 'Bali' }}</span>
                        </div>
                        <h1 class="text-4xl font-bold mb-4">{{ $property->name }}</h1>
                        <div class="flex items-center gap-4 text-base-content/60 mb-6">
                            <div class="flex items-center gap-1">
                                <x-hugeicons-bed-double class="h-5 w-5" />
                                <span>{{ $property->bedroom }} Bedrooms</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <x-hugeicons-bathtub-01 class="h-5 w-5" />
                                <span>{{ (float) $property->bathroom }} Bathrooms</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-base-200 rounded-2xl p-6 mb-8">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-base-content/40 mb-4">Rental Rates</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @if($property->price_daily)
                                <div>
                                    <p class="text-xs text-base-content/60">Daily</p>
                                    <p class="text-lg font-bold text-primary">IDR {{ number_format($property->price_daily) }}</p>
                                </div>
                            @endif
                            @if($property->price_weekly)
                                <div>
                                    <p class="text-xs text-base-content/60">Weekly</p>
                                    <p class="text-lg font-bold text-primary">IDR {{ number_format($property->price_weekly) }}</p>
                                </div>
                            @endif
                            @if($property->price_monthly)
                                <div>
                                    <p class="text-xs text-base-content/60">Monthly</p>
                                    <p class="text-lg font-bold text-primary">IDR {{ number_format($property->price_monthly) }}</p>
                                </div>
                            @endif
                            @if($property->price_yearly)
                                <div>
                                    <p class="text-xs text-base-content/60">Yearly</p>
                                    <p class="text-lg font-bold text-primary">IDR {{ number_format($property->price_yearly) }}</p>
                                </div>
                            @endif
                            @if(!$property->price_daily && !$property->price_weekly && !$property->price_monthly && !$property->price_yearly)
                                <div class="col-span-2">
                                    <p class="text-lg font-bold text-primary">Contact for Pricing</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                        @php
                            $siteSettings = \App\Models\SiteSetting::getSingleton();
                            $waNumber = $siteSettings->whatsapp_number ?? '628123456789';
                            $waText = urlencode("Hello, I'm interested in " . $property->name . ". Can I get more details?");
                            $waUrl = "https://wa.me/{$waNumber}?text={$waText}";
                        @endphp
                        <a 
                            href="{{ $waUrl }}"
                            target="_blank"
                            x-intersect:enter="showSticky = false"
                            x-intersect:leave="showSticky = $el.getBoundingClientRect().top < 0"
                            class="btn btn-primary flex-1 btn-lg font-bold"
                        >
                            <x-hugeicons-whatsapp class="h-6 w-6" />
                            Book Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 border-t pt-12">
                <div class="lg:col-span-1 lg:border-r lg:border-base-300 lg:pr-12 pb-12 lg:pb-0 border-b lg:border-b-0 border-base-300">
                    <h2 class="text-2xl font-bold mb-6">Description</h2>
                    <div class="text-base-content/70 leading-relaxed whitespace-pre-line">
                        {{ $property->description }}
                    </div>
                </div>
                
                <div class="lg:col-span-2">
                    @if($property->amenities->count() > 0)
                        <h2 class="text-2xl font-bold mb-6">Amenities</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($property->amenities as $amenity)
                                <div class="flex items-center gap-3 bg-base-200 p-3 rounded-xl">
                                    <div class="text-primary">
                                        <x-hugeicons-checkmark-circle-01 class="h-5 w-5" />
                                    </div>
                                    <span class="font-medium text-sm">{{ $amenity->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-16 border-t pt-12">
                <h2 class="text-2xl font-bold mb-8">Location</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @if($property->latitude && $property->longitude)
                        <div class="md:col-span-2 rounded-xl overflow-hidden h-[400px] bg-base-200" id="map">
                        </div>
                    @else
                        <div class="md:col-span-2 rounded-xl overflow-hidden h-[400px] bg-base-200 flex flex-col items-center justify-center text-base-content/30 border-2 border-dashed border-base-300">
                            <x-hugeicons-location-01 class="h-16 w-16 mb-4 opacity-20" />
                            <p class="text-xl font-bold">Location not Available</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($property->latitude && $property->longitude)
                <script>
                    document.addEventListener('livewire:initialized', () => {
                        const map = L.map('map').setView([{{ $property->latitude }}, {{ $property->longitude }}], 15);
                        
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(map);

                        L.marker([{{ $property->latitude }}, {{ $property->longitude }}]).addTo(map)
                            .bindPopup('{{ $property->name }}')
                            .openPopup();
                    });
                </script>
            @endif
        </div>
    </section>

    {{-- Sticky Book Now for Mobile --}}
    <div 
        x-show="showSticky"
        x-transition
        class="lg:hidden fixed bottom-0 left-0 right-0 bg-base-100/80 backdrop-blur-md border-t border-base-200 p-4 z-50"
    >
        <a href="{{ $waUrl }}" target="_blank" class="btn btn-primary w-full btn-lg font-bold">
            <x-hugeicons-whatsapp class="h-6 w-6" />
            Book Now
        </a>
    </div>
</div>
