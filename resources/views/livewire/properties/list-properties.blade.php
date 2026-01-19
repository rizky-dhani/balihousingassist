<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Our Properties</h1>
            <p class="text-base-content/70">Find your perfect stay in Bali - from daily rentals to yearly leases, we cover it all!</p>
        </div>
            
        <div class="collapse collapse-arrow bg-base-200 rounded-2xl mb-12">
            <input type="checkbox" />
            <div class="collapse-title text-lg font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                Advanced Filters
            </div>
            <div class="collapse-content">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end pt-4">
                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Category</span></label>
                        <select wire:model="category_id" class="select select-bordered w-full">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Location</span></label>
                        <select wire:model="location" class="select select-bordered w-full">
                            <option value="">All Locations</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}">{{ $loc }}</option>
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
                        <button wire:click="resetFilters" class="btn btn-ghost btn-square" title="Reset Filters">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($properties as $property)
                <x-single-property :property="$property" />
            @endforeach
        </div>

        <div class="mt-12">
            {{ $properties->links() }}
        </div>
    </div>
</section>
