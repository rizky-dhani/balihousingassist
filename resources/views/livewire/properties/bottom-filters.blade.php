<div x-data="{ 
    open: @entangle('showBottomFilters').live,
    isAdvancedFiltersOpen: @entangle('isAdvancedFiltersOpen').live,
    isSortOpen: false 
}" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full" class="fixed bottom-0 inset-x-0 p-4 shadow-2xl z-40">
    <div class="max-w-md mx-auto flex flex-col gap-2">
        <!-- Sort Panel -->
        <div x-show="isSortOpen" 
             @click.away="isSortOpen = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="bg-base-100 rounded-3xl overflow-hidden shadow-2xl border border-base-200" x-cloak>
            <div class="p-4 border-b border-base-200 flex items-center justify-between bg-base-200/50">
                <h3 class="font-bold">Sort Properties</h3>
                <button @click="isSortOpen = false" class="btn btn-ghost btn-xs btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-2 flex flex-col gap-1">
                <button wire:click="$set('sortBy', 'latest')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between rounded-xl {{ $sortBy === 'latest' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Newest First
                    @if($sortBy === 'latest') <x-hugeicons-checkmark-circle-01 class="h-4 w-4" /> @endif
                </button>
                <button wire:click="$set('sortBy', 'oldest')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between rounded-xl {{ $sortBy === 'oldest' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Oldest First
                    @if($sortBy === 'oldest') <x-hugeicons-checkmark-circle-01 class="h-4 w-4" /> @endif
                </button>
                <button wire:click="$set('sortBy', 'price_low')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between rounded-xl {{ $sortBy === 'price_low' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Price: Low to High
                    @if($sortBy === 'price_low') <x-hugeicons-checkmark-circle-01 class="h-4 w-4" /> @endif
                </button>
                <button wire:click="$set('sortBy', 'price_high')" @click="isSortOpen = false" class="btn btn-ghost btn-sm justify-between rounded-xl {{ $sortBy === 'price_high' ? 'bg-primary/10 text-primary font-bold' : '' }}">
                    Price: High to Low
                    @if($sortBy === 'price_high') <x-hugeicons-checkmark-circle-01 class="h-4 w-4" /> @endif
                </button>
            </div>
        </div>

        <!-- Main Bar -->
        <div class="bg-base-100/80 backdrop-blur-lg rounded-full p-2 shadow-2xl border border-base-200 flex items-center justify-between gap-2">
            <button @click="isSortOpen = !isSortOpen; isAdvancedFiltersOpen = false" class="btn btn-ghost btn-md rounded-full flex-1 flex flex-col items-center gap-0 h-auto py-1">
                <span class="text-[10px] font-bold opacity-40 uppercase tracking-tighter">Sort</span>
                <span class="text-xs font-bold text-primary truncate max-w-[80px]">
                    @if($sortBy === 'latest') Newest @elseif($sortBy === 'oldest') Oldest @elseif($sortBy === 'price_low') Price ↑ @else Price ↓ @endif
                </span>
            </button>
            
            <div class="h-8 w-[1px] bg-base-200"></div>

            <button class="btn btn-neutral btn-md rounded-full px-6 flex items-center gap-2 shadow-xl shadow-neutral/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                <span class="font-bold">Map</span>
            </button>

            <div class="h-8 w-[1px] bg-base-200"></div>

            <button @click="$dispatch('open-advanced-filters')" class="btn btn-ghost btn-md rounded-full flex-1 flex flex-col items-center gap-0 h-auto py-1">
                <span class="text-[10px] font-bold opacity-40 uppercase tracking-tighter">Filter</span>
                <span class="text-xs font-bold text-primary">Advanced</span>
            </button>
        </div>
    </div>
</div>