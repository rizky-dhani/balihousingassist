@props(['images' => [], 'name' => 'Property', 'mainImage' => null])

@php
    $images = collect($images);
    
    // Combine mainImage with other images for the thumbnails
    $allImages = collect();
    if ($mainImage) {
        $allImages->push($mainImage);
    }
    $allImages = $allImages->concat($images);

    $allImageUrls = $allImages->map(function($image) {
        return \Illuminate\Support\Facades\Storage::url($image);
    })->toArray();

    if (empty($allImageUrls)) {
        $allImageUrls = ['https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80'];
    }
@endphp

<div 
    class="flex flex-col items-center space-y-4"
    x-data="{ 
        currentIndex: 0, 
        showLightbox: false, 
        images: @js($allImageUrls),
        next() { this.currentIndex = (this.currentIndex + 1) % this.images.length },
        prev() { this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length }
    }"
    @keydown.window.escape="showLightbox = false"
    @keydown.window.left="prev()"
    @keydown.window.right="next()"
>
    <div class="w-full rounded-xl overflow-hidden shadow-sm relative group cursor-zoom-in">
        <img 
            :src="images[currentIndex]" 
            class="w-full h-[400px] object-cover transition-transform duration-500 group-hover:scale-105" 
            alt="{{ $name }}"
            @click="showLightbox = true"
        >
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors pointer-events-none flex items-center justify-center">
            <x-hugeicons-property-search class="size-10 text-white opacity-0 group-hover:opacity-100 transition-opacity" />
        </div>
    </div>

    @if(count($allImageUrls) > 1)
    <div class="grid grid-cols-4 w-full gap-4">
        @foreach(array_slice($allImageUrls, 0, 4) as $index => $imageUrl)
            <div 
                class="relative cursor-pointer group"
                @click="currentIndex = {{ $index }}; if({{ $index === 3 && count($allImageUrls) > 4 ? 'true' : 'false' }}) showLightbox = true"
            >
                <img 
                    src="{{ $imageUrl }}" 
                    class="rounded-lg md:h-24 h-14 w-full object-cover transition-all" 
                    :class="currentIndex === {{ $index }} ? 'ring-2 ring-primary ring-offset-2' : 'hover:opacity-80'"
                    alt="{{ $name }} - Thumb {{ $index + 1 }}"
                >
                @if($index === 3 && count($allImageUrls) > 4)
                    <div class="absolute inset-0 bg-black/50 rounded-lg flex items-center justify-center text-white font-bold group-hover:bg-black/40 transition-colors">
                        +{{ count($allImageUrls) - 4 }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    {{-- Lightbox --}}
    <template x-teleport="body">
        <div 
            x-show="showLightbox" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[200] flex items-center justify-center bg-black/95 backdrop-blur-xl p-4 md:p-12"
            x-cloak
        >
            {{-- Close Button --}}
            <button 
                @click="showLightbox = false" 
                class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors z-[210] p-2"
            >
                <x-hugeicons-cancel-01 class="size-8" />
            </button>

            {{-- Navigation --}}
            <button 
                @click="prev()" 
                class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white/30 hover:text-white transition-colors z-[210] p-4 group"
            >
                <x-hugeicons-arrow-left-01 class="size-10 md:size-16 group-hover:-translate-x-1 transition-transform" />
            </button>
            <button 
                @click="next()" 
                class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white/30 hover:text-white transition-colors z-[210] p-4 group"
            >
                <x-hugeicons-arrow-right-01 class="size-10 md:size-16 group-hover:translate-x-1 transition-transform" />
            </button>

            {{-- Counter --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full text-white/70 text-sm font-bold tracking-widest z-[210]">
                <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
            </div>

            {{-- Main Image in Lightbox --}}
            <div class="relative w-full h-full flex items-center justify-center" @click.self="showLightbox = false">
                <img 
                    :src="images[currentIndex]" 
                    class="max-w-full max-h-full object-contain shadow-2xl rounded-sm select-none"
                    x-transition:enter="transition ease-out duration-300 delay-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    alt="{{ $name }}"
                >
            </div>
        </div>
    </template>
</div>
