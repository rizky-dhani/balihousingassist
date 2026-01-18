@extends('layouts.app')

@section('title', 'Property Catalog - Bali Housing Assist')

@section('content')
<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold mb-2">Our Property Catalog</h1>
                <p class="text-base-content/70">Find your perfect stay in Bali - from daily rentals to yearly leases.</p>
            </div>
            
            <div class="mt-4 md:mt-0 flex gap-2">
                <form action="{{ route('properties.index') }}" method="GET" class="flex gap-2">
                    <select name="type" class="select select-bordered w-full max-w-xs" onchange="this.form.submit()">
                        <option value="">All Types</option>
                        <option value="Villa" {{ request('type') == 'Villa' ? 'selected' : '' }}>Villas</option>
                        <option value="Guest House" {{ request('type') == 'Guest House' ? 'selected' : '' }}>Guest Houses</option>
                        <option value="Loft" {{ request('type') == 'Loft' ? 'selected' : '' }}>Lofts</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($properties as $property)
            <a href="{{ route('properties.show', $property->slug) }}" class="group relative block overflow-hidden rounded-lg border bg-base-100 transition-all hover:shadow-lg">
                <div class="relative h-64 overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80"
                        alt="{{ $property->name }}"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-110"
                    />
                    <div class="absolute top-4 left-4">
                        <span class="badge badge-primary px-3 py-1">{{ $property->type }}</span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm text-base-content/60">{{ $property->location }}</p>
                        <p class="text-sm font-medium text-success">{{ $property->is_available ? 'Available Now' : 'Booked' }}</p>
                    </div>

                    <h3 class="text-xl font-bold group-hover:text-primary transition-colors mb-4">
                        {{ $property->name }}
                    </h3>

                    <div class="border-t pt-4">
                        <div class="flex flex-wrap gap-x-4 gap-y-2">
                            @if($property->price_daily)
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold">Daily</p>
                                <p class="text-lg font-bold">IDR {{ number_format($property->price_daily) }}</p>
                            </div>
                            @endif
                            @if($property->price_monthly)
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold">Monthly</p>
                                <p class="text-lg font-bold">IDR {{ number_format($property->price_monthly) }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $properties->links() }}
        </div>
    </div>
</section>
@endsection
