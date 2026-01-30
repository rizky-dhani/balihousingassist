<div x-data="{ showSticky: false }">
    <section class="bg-base-100 pt-8 pb-24 lg:py-12 px-4 lg:px-8">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
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
                        <p class="text-base-content/70 leading-relaxed">
                            {{ $property->description }}
                        </p>
                    </div>

                    <div class="bg-base-200 rounded-2xl p-6 mb-8">
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-primary">{{ $property->price_daily ? 'IDR ' . number_format($property->price_daily) : 'Ask' }}</span>
                            @if($property->price_daily)
                                <span class="text-base-content/50 font-medium">/ night</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                        <button 
                            x-intersect:enter="showSticky = false"
                            x-intersect:leave="showSticky = $el.getBoundingClientRect().top < 0"
                            class="btn btn-primary flex-1 btn-lg"
                        >
                            Book Now
                        </button>
                    </div>
                </div>
            </div>

            @include('livewire.properties.partials.amenities')

            <div class="mt-16 border-t pt-12">
                <h2 class="text-2xl font-bold mb-8">Location & Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 rounded-xl overflow-hidden h-[300px] bg-base-200 flex items-center justify-center text-base-content/40">
                        <span class="flex flex-col items-center">
                            <x-hugeicons-location-01 class="h-12 w-12 mb-2" />
                            Map View Placeholder
                        </span>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Address</h4>
                        <p class="text-base-content/70">{{ $property->location?->address_line_1 ?? 'Address not set' }}</p>
                        <p class="mt-2 text-primary font-medium">{{ $property->location?->city ?? 'Bali' }}, Bali</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sticky Book Now for Mobile --}}
    <div 
        x-show="showSticky"
        x-transition
        class="lg:hidden fixed bottom-0 left-0 right-0 bg-base-100/80 backdrop-blur-md border-t border-base-200 p-4 z-50"
    >
        <button class="btn btn-primary w-full btn-lg">Book Now</button>
    </div>
</div>