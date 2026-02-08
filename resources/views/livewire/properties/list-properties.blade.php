<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto" x-data="{
    init() {
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const isMobile = window.innerWidth < 1024; // Tailwind's lg breakpoint
                if (isMobile) {
                    if (entry.isIntersecting) {
                        @this.set('showBottomFilters', false);
                    } else {
                        @this.set('showBottomFilters', true);
                    }
                } else {
                    @this.set('showBottomFilters', false); // Always hide on larger screens
                }
            });
        }, { threshold: 0 });

        observer.observe(document.getElementById('advanced-filters-top'));
    },
}">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold mb-2">Our Properties</h1>
                <p class="text-base-content/70">Find your perfect stay in Bali - from daily rentals to yearly leases, we cover it all!</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-bold opacity-50 uppercase whitespace-nowrap">Sort By</span>
                <select wire:model.live="sortBy" class="select select-bordered select-sm w-full md:w-auto">
                    <option value="latest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="price_low">Price: Low to High</option>
                    <option value="price_high">Price: High to Low</option>
                </select>
            </div>
        </div>
            <div id="advanced-filters-top" x-data="{ isAdvancedFiltersOpen: @entangle('isAdvancedFiltersOpen').live }" class="collapse collapse-arrow bg-base-200 rounded-2xl mb-12">
                <input type="checkbox" x-model="isAdvancedFiltersOpen" />
                <div class="collapse-title text-lg font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                    Advanced Filters
                </div>
                <div class="collapse-content">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end pt-4 pb-4">
                        <div class="form-control w-full lg:col-span-2">
                            <label class="label"><span class="label-text font-bold">Search Keywords</span></label>
                            <input wire:model="search" type="text" placeholder="Villa name, description..." class="input input-bordered w-full" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-bold">Category</span></label>
                            <select wire:model="category" class="select select-bordered w-full">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-bold">Location</span></label>
                            <select wire:model="property_location_id" class="select select-bordered w-full">
                                <option value="">All Locations</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-bold">Bedrooms</span></label>
                            <select wire:model="bedroom" class="select select-bordered w-full">
                                <option value="">Any</option>
                                @foreach(range(1, 10) as $num)
                                    <option value="{{ $num }}">{{ $num }}+ Beds</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-bold">Bathrooms</span></label>
                            <select wire:model="bathroom" class="select select-bordered w-full">
                                <option value="">Any</option>
                                @foreach([1, 1.5, 2, 2.5, 3, 3.5, 4, 5] as $num)
                                    <option value="{{ $num }}">{{ $num }}+ Baths</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-2 w-full lg:w-auto">
                            <button wire:click="applyFilters" class="btn btn-primary flex-1">
                                Apply Filters
                            </button>
                            <button wire:click="resetFilters" class="btn btn-secondary flex-1">
                                Reset Filters
                            </button>
                            <button @click="isAdvancedFiltersOpen = !isAdvancedFiltersOpen" class="btn btn-ghost btn-square" title="Close Filters">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>        
    </div>
    <div class="max-w-screen-xl mx-auto">
        {{-- Skeleton Loading --}}
        <div wire:loading.grid wire:target="sortBy, category, property_location_id, bedroom, bathroom, applyFilters, resetFilters" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach(range(1, 8) as $i)
                <x-property-skeleton />
            @endforeach
        </div>

        {{-- Properties Grid --}}
        <div wire:loading.remove wire:target="sortBy, category, property_location_id, bedroom, bathroom, applyFilters, resetFilters" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($properties as $property)
                <x-single-property :property="$property" />
            @endforeach
        </div>

        <div class="mt-12">
            @if($properties->hasMorePages())
                <div wire:intersect="loadMore" class="flex justify-center py-8">
                    <div wire:loading.remove wire:target="loadMore">
                        {{-- This hidden div helps trigger intersection even if spinner is not yet shown --}}
                        <div class="h-1"></div>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <span class="loading loading-spinner loading-lg text-primary"></span>
                        <p class="text-sm text-base-content/50">Loading more properties...</p>
                    </div>
                </div>
            @else
                <div class="flex justify-center py-8">
                    <p class="text-base-content/50">You've reached the end of our listings.</p>
                </div>
            @endif
            
            @include('livewire.properties.bottom-filters')
        </div>
    </div>
</section>
