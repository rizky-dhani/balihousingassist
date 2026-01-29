<div x-data="{ open: @entangle('showBottomFilters').live }" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full" class="fixed bottom-0 inset-x-0 p-4 shadow-lg z-40 lg:hidden">
    <div class="max-w-screen-xl mx-auto flex flex-col gap-2">
        <div class="bg-base-100 rounded-2xl p-2 shadow-sm border border-base-200 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 px-2">
                <span class="text-xs font-bold opacity-50 uppercase whitespace-nowrap">Sort</span>
                <select wire:model.live="sortBy" class="select select-bordered select-xs">
                    <option value="latest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="price_low">Price ↑</option>
                    <option value="price_high">Price ↓</option>
                </select>
            </div>
            <div class="h-4 w-[1px] bg-base-300"></div>
            <button @click="$dispatch('toggle-advanced-filters')" class="btn btn-ghost btn-xs gap-2 flex-1 justify-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                Advanced Filters
            </button>
        </div>

        <div x-data="{ isAdvancedFiltersOpen: @entangle('isAdvancedFiltersOpen').live }" 
             x-show="isAdvancedFiltersOpen"
             x-on:toggle-advanced-filters.window="isAdvancedFiltersOpen = !isAdvancedFiltersOpen"
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
                        <select wire:model.live="category_id" class="select select-bordered select-sm w-full">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
    </div>
</div>
