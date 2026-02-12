<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto" x-data="{
    init() {
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.set('showBottomFilters', false);
                } else {
                    @this.set('showBottomFilters', true);
                }
            });
        }, { threshold: 0 });

        observer.observe(document.getElementById('advanced-filters-top'));
    },
}">
        {{-- Hero Section --}}
        <div class="mb-12 text-center">
            <h1 class="text-4xl lg:text-5xl font-extrabold mb-4 tracking-tight">Discover Your Dream Stay in Bali</h1>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">From daily retreats to yearly sanctuaries, explore our curated collection of luxury properties across the island.</p>
        </div>

        {{-- Category Navigation Bar --}}
        <div class="relative group mb-8" x-data="{
            slider: null,
            init() {
                this.slider = this.$refs.slider;
            },
            scrollLeft() {
                this.slider.scrollBy({ left: -200, behavior: 'smooth' });
            },
            scrollRight() {
                this.slider.scrollBy({ left: 200, behavior: 'smooth' });
            },
            canScrollLeft: false,
            canScrollRight: false,
            updateScrollButtons() {
                this.canScrollLeft = this.slider.scrollLeft > 0;
                this.canScrollRight = this.slider.scrollLeft < this.slider.scrollWidth - this.slider.clientWidth - 10;
            }
        }" x-init="updateScrollButtons" @scroll.window="updateScrollButtons">
            <div class="absolute left-0 top-1/2 -translate-y-1/2 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button @click="scrollLeft()" x-show="canScrollLeft" class="btn btn-circle btn-sm btn-primary shadow-lg bg-base-100" x-cloak>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>
            </div>
            <div x-ref="slider" class="border-b border-base-200 pb-2 overflow-x-auto no-scrollbar flex items-center gap-4 px-4 lg:gap-6 scroll-smooth" @scroll="updateScrollButtons()">
                <button wire:click="$set('category', '')" class="flex flex-col items-center gap-2 group border-b-2 transition-all pb-2 whitespace-nowrap flex-shrink-0 {{ $category === '' ? 'border-primary text-primary opacity-100' : 'border-transparent opacity-60 hover:opacity-100 hover:border-base-300' }}">
                    <x-hugeicons-grid-view class="size-6 group-hover:scale-110 transition-transform" />
                    <span class="text-xs font-bold uppercase tracking-wider">All</span>
                </button>
                @foreach($categories as $cat)
                    <button wire:click="$set('category', '{{ $cat->slug }}')" class="flex flex-col items-center gap-2 group border-b-2 transition-all pb-2 whitespace-nowrap flex-shrink-0 {{ $category === $cat->slug ? 'border-primary text-primary opacity-100' : 'border-transparent opacity-60 hover:opacity-100 hover:border-base-300' }}">
                        <x-dynamic-component :component="$cat->icon ?? 'hugeicons-house-01'" class="size-6 group-hover:scale-110 transition-transform" />
                        <span class="text-xs font-bold uppercase tracking-wider">{{ $cat->name }}</span>
                    </button>
                @endforeach
            </div>
            <div class="absolute right-0 top-1/2 -translate-y-1/2 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button @click="scrollRight()" x-show="canScrollRight" class="btn btn-circle btn-sm btn-primary shadow-lg bg-base-100" x-cloak>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>

        <div class="mb-8 flex flex-col lg:flex-row items-stretch lg:items-center gap-4 bg-base-100 p-4 rounded-3xl border border-base-200 shadow-sm" id="advanced-filters-top">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input wire:model.live.debounce.500ms="search" type="text" placeholder="Search villa name or location..." class="input input-bordered w-full pl-12 rounded-2xl bg-base-200/50 border-none focus:bg-base-100 transition-colors h-12" />
            </div>

            <div class="flex items-center gap-2">
                <div class="dropdown dropdown-end w-full lg:w-auto">
                    <div tabindex="0" role="button" class="btn btn-ghost border border-base-200 rounded-2xl h-12 w-full lg:w-auto px-6">
                        <span class="text-sm font-bold opacity-50 uppercase mr-2">Sort:</span>
                        <span class="text-sm font-bold">
                            @if($sortBy === 'latest') Newest @elseif($sortBy === 'oldest') Oldest @elseif($sortBy === 'price_low') Price Low @else Price High @endif
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-50 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 mt-2">
                        <li><a wire:click="$set('sortBy', 'latest')" class="{{ $sortBy === 'latest' ? 'active' : '' }}">Newest First</a></li>
                        <li><a wire:click="$set('sortBy', 'oldest')" class="{{ $sortBy === 'oldest' ? 'active' : '' }}">Oldest First</a></li>
                        <li><a wire:click="$set('sortBy', 'price_low')" class="{{ $sortBy === 'price_low' ? 'active' : '' }}">Price: Low to High</a></li>
                        <li><a wire:click="$set('sortBy', 'price_high')" class="{{ $sortBy === 'price_high' ? 'active' : '' }}">Price: High to Low</a></li>
                    </ul>
                </div>

                <button @click="$dispatch('open-advanced-filters')" class="btn btn-primary rounded-2xl h-12 px-6 shadow-md shadow-primary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                    Filters
                </button>
            </div>
        </div>

        <div x-data="{ open: false }" x-on:open-advanced-filters.window="open = true" x-show="open" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-cloak>
            <div @click.away="open = false" class="bg-base-100 rounded-3xl shadow-2xl w-full max-w-xl overflow-hidden">
                <div class="p-6 border-b border-base-200 flex items-center justify-between">
                    <h2 class="text-xl font-bold">Advanced Filters</h2>
                    <button @click="open = false" class="btn btn-ghost btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Location</span></label>
                        <select wire:model="property_location_id" class="select select-bordered w-full rounded-xl">
                            <option value="">All Locations</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Bedrooms</span></label>
                        <select wire:model="bedroom" class="select select-bordered w-full rounded-xl">
                            <option value="">Any</option>
                            @foreach(range(1, 10) as $num)
                                <option value="{{ $num }}">{{ $num }}+ Beds</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Bathrooms</span></label>
                        <select wire:model="bathroom" class="select select-bordered w-full rounded-xl">
                            <option value="">Any</option>
                            @foreach([1, 1.5, 2, 2.5, 3, 3.5, 4, 5] as $num)
                                <option value="{{ $num }}">{{ $num }}+ Baths</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full col-span-1 sm:col-span-2">
                        <label class="label"><span class="label-text font-bold">Price Range (Daily)</span></label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <input type="number" wire:model="min_price" placeholder="Min Price" min="0" max="10000000" step="100000" class="input input-bordered w-full rounded-xl" />
                                <label class="label">
                                    <span class="label-text-alt text-base-content/50">Min: {{ $min_price ? 'IDR ' . number_format($min_price, 0, ',', '.') : 'Any' }}</span>
                                </label>
                            </div>
                            <div>
                                <input type="number" wire:model="max_price" placeholder="Max Price" min="0" max="10000000" step="100000" class="input input-bordered w-full rounded-xl" />
                                <label class="label">
                                    <span class="label-text-alt text-base-content/50">Max: {{ $max_price ? 'IDR ' . number_format($max_price, 0, ',', '.') : 'Any' }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-base-200 flex gap-4">
                    <button wire:click="resetFilters" @click="open = false" class="btn btn-secondary flex-1 rounded-xl font-bold">Reset</button>
                    <button wire:click="applyFilters" @click="open = false" class="btn btn-primary flex-1 rounded-xl font-bold">Show Results</button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto px-4 lg:px-8">
        {{-- Skeleton Loading --}}
        <div wire:loading.grid wire:target="sortBy, category, property_location_id, bedroom, bathroom, min_price, max_price, applyFilters, resetFilters" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach(range(1, 8) as $i)
                <x-property-skeleton />
            @endforeach
        </div>

        {{-- Properties Grid --}}
        <div wire:loading.remove wire:target="sortBy, category, property_location_id, bedroom, bathroom, min_price, max_price, applyFilters, resetFilters" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
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
