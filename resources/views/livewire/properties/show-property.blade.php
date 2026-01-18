<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div>
                <div class="rounded-xl overflow-hidden shadow-sm mb-4">
                    <img
                        src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80"
                        alt="{{ $property->name }}"
                        class="w-full h-[400px] object-cover"
                    />
                </div>
                
                <div class="grid grid-cols-4 gap-4">
                    <img src="https://images.unsplash.com/photo-1512918766671-ed6a47ca025a?auto=format&fit=crop&w=300&q=80" class="rounded-lg h-24 w-full object-cover cursor-pointer hover:opacity-80" />
                    <img src="https://images.unsplash.com/photo-1449156003053-c2d2247bd39c?auto=format&fit=crop&w=300&q=80" class="rounded-lg h-24 w-full object-cover cursor-pointer hover:opacity-80" />
                    <img src="https://images.unsplash.com/photo-1513584684374-8bdb7489feef?auto=format&fit=crop&w=300&q=80" class="rounded-lg h-24 w-full object-cover cursor-pointer hover:opacity-80" />
                    <div class="relative rounded-lg h-24 w-full overflow-hidden cursor-pointer group">
                        <img src="https://images.unsplash.com/photo-1480074568708-e7b720bb3f09?auto=format&fit=crop&w=300&q=80" class="h-full w-full object-cover" />
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-white font-bold group-hover:bg-black/40">+12</div>
                    </div>
                </div>
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
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @if($property->price_daily)
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Daily</p>
                            <p class="text-sm font-bold truncate">IDR {{ number_format($property->price_daily) }}</p>
                        </div>
                        @endif
                        @if($property->price_weekly)
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Weekly</p>
                            <p class="text-sm font-bold truncate">IDR {{ number_format($property->price_weekly) }}</p>
                        </div>
                        @endif
                        @if($property->price_monthly)
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Monthly</p>
                            <p class="text-sm font-bold truncate">IDR {{ number_format($property->price_monthly) }}</p>
                        </div>
                        @endif
                        @if($property->price_yearly)
                        <div class="bg-base-100 p-4 rounded-xl text-center">
                            <p class="text-xs text-base-content/50 uppercase font-bold mb-1">Yearly</p>
                            <p class="text-sm font-bold truncate">IDR {{ number_format($property->price_yearly) }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                    <button class="btn btn-primary flex-1 btn-lg">Book Short Term</button>
                    <button class="btn btn-outline flex-1 btn-lg">Inquire Long Lease</button>
                </div>
            </div>
        </div>

        <div class="mt-16 border-t pt-12">
            <h2 class="text-2xl font-bold mb-8">Location & Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2 rounded-xl overflow-hidden h-[300px] bg-base-200 flex items-center justify-center text-base-content/40">
                    <span class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
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
