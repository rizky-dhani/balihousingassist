@if($property->amenities->count() > 0)
<div class="mt-16 border-t pt-12">
    <h2 class="text-2xl font-bold mb-8">Amenities</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($property->amenities as $amenity)
        <div class="flex items-center gap-3">
            <div class="bg-primary/10 p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <span class="font-medium text-base-content/80">{{ $amenity->name }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif
