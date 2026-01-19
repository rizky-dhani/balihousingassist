<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div>
                @php
                    $images = $property->images ?? [];
                    $mainImage = !empty($images) ? \Illuminate\Support\Facades\Storage::url($images[0]) : 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80';
                @endphp
                <div class="rounded-xl overflow-hidden shadow-sm mb-4">
                    <img
                        src="{{ $mainImage }}"
                        alt="{{ $property->name }}"
                        class="w-full h-[400px] object-cover"
                    />
                </div>
                
                @if(count($images) > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach(collect($images)->slice(1, 3) as $image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image) }}" class="rounded-lg h-24 w-full object-cover cursor-pointer hover:opacity-80" />
                    @endforeach
                    
                    @if(count($images) > 4)
                    <div class="relative rounded-lg h-24 w-full overflow-hidden cursor-pointer group">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($images[4]) }}" class="h-full w-full object-cover" />
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-white font-bold group-hover:bg-black/40">+{{ count($images) - 4 }}</div>
                    </div>
                    @elseif(count($images) === 4)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($images[3]) }}" class="rounded-lg h-24 w-full object-cover cursor-pointer hover:opacity-80" />
                    @endif
                </div>
                @endif
            </div>

            <div class="flex flex-col">
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="badge badge-primary">{{ $property->type }}</span>
                        <span class="badge badge-ghost text-base-content/60">{{ $property->location }}</span>
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
                    <p class="text-base-content/70">{{ $property->address }}</p>
                    <p class="mt-2 text-primary font-medium">{{ $property->location }}, Bali</p>
                </div>
            </div>
        </div>
    </div>
</section>
