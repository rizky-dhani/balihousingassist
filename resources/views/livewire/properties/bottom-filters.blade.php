<div x-data="{ 
    open: @entangle('showBottomFilters').live,
    isAdvancedFiltersOpen: @entangle('isAdvancedFiltersOpen').live,
    isSortOpen: false 
}" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full" class="fixed bottom-0 inset-x-0 p-4 shadow-lg z-40 lg:hidden">
    <div class="max-w-screen-xl mx-auto flex flex-col gap-2">
        <!-- Sort Panel -->
        <div x-show="isSortOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="bg-base-200 rounded-2xl overflow-hidden shadow-xl border border-base-300">
            <div class="p-4 border-b border-base-300 flex items-center justify-between">
                <h3 class="font-bold">Sort By</h3>
                <button @click="isSortOpen = false" class="btn btn-ghost btn-xs btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-2 flex flex-col gap-1">
                <button wire:click="$set('sortBy', 'latest')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between {{ $sortBy === 'latest' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Newest
                    @if($sortBy === 'latest') <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> @endif
                </button>
                <button wire:click="$set('sortBy', 'oldest')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between {{ $sortBy === 'oldest' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Oldest
                    @if($sortBy === 'oldest') <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> @endif
                </button>
                <button wire:click="$set('sortBy', 'price_low')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between {{ $sortBy === 'price_low' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Price: Low to High
                    @if($sortBy === 'price_low') <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> @endif
                </button>
                <button wire:click="$set('sortBy', 'price_high')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between {{ $sortBy === 'price_high' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Price: High to Low
                    @if($sortBy === 'price_high') <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> @endif
                </button>
            </div>
        </div>

        <!-- Advanced Filters Panel -->
        <div x-show="isAdvancedFiltersOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="bg-base-200 rounded-2xl overflow-hidden shadow-xl border border-base-300">
            <div class="p-4 border-b border-base-300 flex items-center justify-between">
                <h3 class="font-bold">Advanced Filters</h3>
                <button @click="isAdvancedFiltersOpen = false" class="btn btn-ghost btn-xs btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-2 gap-4 items-end">
                    <div class="form-control w-full">
                        <label class="label p-1"><span class="label-text text-xs font-bold">Category</span></label>
                        <select wire:model.live="category" class="select select-bordered select-sm w-full">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label p-1"><span class="label-text text-xs font-bold">Location</span></label>
                        <select wire:model.live="property_location_id" class="select select-bordered select-sm w-full">
                            <option value="">All Locations</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label p-1"><span class="label-text text-xs font-bold">Bedrooms</span></label>
                        <select wire:model.live="bedroom" class="select select-bordered select-sm w-full">
                            <option value="">Any</option>
                            @foreach(range(1, 10) as $num)
                                <option value="{{ $num }}">{{ $num }}+ Beds</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label p-1"><span class="label-text text-xs font-bold">Bathrooms</span></label>
                        <select wire:model.live="bathroom" class="select select-bordered select-sm w-full">
                            <option value="">Any</option>
                            @foreach([1, 1.5, 2, 2.5, 3, 3.5, 4, 5] as $num)
                                <option value="{{ $num }}">{{ $num }}+ Baths</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex gap-2 w-full mt-4">
                    <button wire:click="applyFilters" @click="isAdvancedFiltersOpen = false" class="btn btn-primary btn-sm flex-1">
                        Apply
                    </button>
                    <button wire:click="resetFilters" @click="isAdvancedFiltersOpen = false" class="btn btn-secondary btn-sm flex-1">
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Bar -->
        <div class="bg-base-100 rounded-2xl p-2 shadow-sm border border-base-200 flex items-center justify-between gap-4">
            <button @click="isSortOpen = !isSortOpen; isAdvancedFiltersOpen = false" class="btn btn-ghost btn-xs gap-2 flex-1 justify-start border border-base-200">
                <span class="text-xs font-bold opacity-50 uppercase whitespace-nowrap">Sort:</span>
                <span class="font-bold text-primary">
                    @if($sortBy === 'latest') Newest @elseif($sortBy === 'oldest') Oldest @elseif($sortBy === 'price_low') Price ↑ @else Price ↓ @endif
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-50 transition-transform duration-200" :class="{ 'rotate-180': isSortOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
            <div class="h-4 w-[1px] bg-base-300"></div>
            <button @click="isAdvancedFiltersOpen = !isAdvancedFiltersOpen; isSortOpen = false" class="btn btn-ghost btn-xs gap-2 flex-1 justify-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                Advanced Filters
            </button>
        </div>
    </div>
</div>
