@props(['images' => [], 'name' => 'Property'])

@php
    $images = collect($images);
    $mainImage = $images->first() ? \Illuminate\Support\Facades\Storage::url($images->first()) : 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80';
@endphp

<div class="flex flex-col items-center space-y-4">
    <div class="w-full rounded-xl overflow-hidden shadow-sm">
        <img 
            id="main-image" 
            src="{{ $mainImage }}" 
            class="w-full h-[400px] object-cover" 
            alt="{{ $name }}"
        >
    </div>

    @if($images->count() > 1)
    <div class="grid grid-cols-4 w-full gap-4" id="thumbnail-container">
        @foreach($images->take(4) as $index => $image)
            <div class="relative {{ $index === 3 && $images->count() > 4 ? 'cursor-pointer group' : '' }}">
                <img 
                    src="{{ \Illuminate\Support\Facades\Storage::url($image) }}" 
                    class="thumb rounded-lg md:h-24 h-14 w-full object-cover cursor-pointer hover:opacity-80 transition-opacity" 
                    alt="{{ $name }} - Thumb {{ $index + 1 }}"
                >
                @if($index === 3 && $images->count() > 4)
                    <div class="absolute inset-0 bg-black/50 rounded-lg flex items-center justify-center text-white font-bold pointer-events-none group-hover:bg-black/40">
                        +{{ $images->count() - 4 }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @endif
</div>

<script>
    (function() {
        const container = document.getElementById('thumbnail-container');
        if (container) {
            container.addEventListener('click', function (e) {
                if (e.target.classList.contains('thumb')) {
                    document.getElementById('main-image').src = e.target.src;
                }
            });
        }
    })();
</script>
