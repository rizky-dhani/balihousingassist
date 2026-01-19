<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <x-property-gallery :images="$property->images" :name="$property->name" />

            <div class="flex flex-col">
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="badge badge-primary">{{ $property->type }}</span>
                        <span class="badge badge-ghost text-base-content/60">{{ $property->location_details?->city ?? $property->location }}</span>
                    </div>
                    <h1 class="text-4xl font-bold mb-4">{{ $property->name }}</h1>
                    <p class="text-base-content/70 leading-relaxed">
                        {{ $property->description }}
                    </p>
                </div>

                <div class="bg-base-200 rounded-2xl p-6 mb-8">
                    <h3 class="font-bold text-lg mb-4">Stay Rates</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Daily</p>
                            <p class="text-sm font-bold truncate">{{ $property->price_daily ? 'IDR ' . number_format($property->price_daily) : 'Ask' }}</p>
                        </div>
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Weekly</p>
                            <p class="text-sm font-bold truncate">{{ $property->price_weekly ? 'IDR ' . number_format($property->price_weekly) : 'Ask' }}</p>
                        </div>
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Monthly</p>
                            <p class="text-sm font-bold truncate">{{ $property->price_monthly ? 'IDR ' . number_format($property->price_monthly) : 'Ask' }}</p>
                        </div>
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Yearly</p>
                            <p class="text-sm font-bold truncate">{{ $property->price_yearly ? 'IDR ' . number_format($property->price_yearly) : 'Ask' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                    <button class="btn btn-primary flex-1 btn-lg">Book Now</button>
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
                    <p class="text-base-content/70">{{ $property->location_details?->address_line_1 ?? $property->address }}</p>
                    <p class="mt-2 text-primary font-medium">{{ $property->location_details?->city ?? $property->location }}, Bali</p>
                </div>
            </div>
        </div>
    </div>
</section>
