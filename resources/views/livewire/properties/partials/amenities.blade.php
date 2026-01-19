@if($property->amenities->count() > 0)
<div class="mt-16 border-t pt-12">
    <h2 class="text-2xl font-bold mb-8">Amenities</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($property->amenities as $amenity)
        <div class="flex items-center gap-3">
            <div class="bg-primary/10 p-2 rounded-lg">
                <x-hugeicons-checkmark-circle-01 class="h-5 w-5 text-primary" />
            </div>
            <span class="font-medium text-base-content/80">{{ $amenity->name }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif
