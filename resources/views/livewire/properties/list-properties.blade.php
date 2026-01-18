<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold mb-2">Our Property Catalog</h1>
                <p class="text-base-content/70">Find your perfect stay in Bali - from daily rentals to yearly leases.</p>
            </div>
            
            <div class="mt-4 md:mt-0 flex gap-2">
                <select wire:model.live="type" class="select select-bordered w-full max-w-xs">
                    <option value="">All Types</option>
                    <option value="Villa">Villas</option>
                    <option value="Guest House">Guest Houses</option>
                    <option value="Loft">Lofts</option>
                </select>
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
