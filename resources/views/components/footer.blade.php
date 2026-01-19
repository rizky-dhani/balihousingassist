@php
    $navigation = \App\Models\Navigation::whereNull('parent_id')->orderBy('order')->get();
    $categories = \App\Models\PropertyCategory::all();
    $siteSettings = \App\Models\SiteSetting::getSingleton();
    $whatsappNumber = $siteSettings->whatsapp_number;
    $whatsappUrl = $whatsappNumber ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsappNumber) : '#';
@endphp

<footer class="bg-base-200 pt-16 pb-8 px-4 lg:px-8 border-t border-base-300">
    <div class="max-w-screen-xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            {{-- Brand Section --}}
            <div class="flex flex-col gap-4">
                <a class="block text-primary" href="/">
                    @if ($siteSettings?->logo)
                        <img class="h-12 w-auto" src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ config('app.name') }}">
                    @else
                        <span class="text-2xl font-bold uppercase tracking-wider">{{ config('app.name') }}</span>
                    @endif
                </a>
                <p class="text-base-content/60 text-sm leading-relaxed">
                    Helping you find your perfect home in Bali. Quality service and professional assistance for all your housing needs.
                </p>
            </div>

            {{-- Navigation Section --}}
            <div>
                <h4 class="font-bold text-lg mb-6">Navigation</h4>
                <ul class="flex flex-col gap-3">
                    @foreach($navigation as $item)
                        <li>
                            <a href="{{ $item->url }}" @if($item->new_tab) target="_blank" @endif class="text-base-content/70 hover:text-primary transition-colors text-sm">
                                {{ $item->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Properties Section --}}
            <div>
                <h4 class="font-bold text-lg mb-6">Properties</h4>
                <ul class="flex flex-col gap-3">
                    @forelse($categories as $category)
                        <li>
                            <a href="{{ route('properties.index', ['category' => $category->slug]) }}" class="text-base-content/70 hover:text-primary transition-colors text-sm">
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li class="text-base-content/40 text-sm italic">No categories yet</li>
                    @endforelse
                </ul>
            </div>

            {{-- Helpful Links Section --}}
            <div>
                <h4 class="font-bold text-lg mb-6">Helpful Links</h4>
                <ul class="flex flex-col gap-3">
                    <li>
                        <a href="{{ $whatsappUrl }}" target="_blank" class="text-base-content/70 hover:text-primary transition-colors text-sm">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-base-content/70 hover:text-primary transition-colors text-sm">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div class="border-t border-base-300 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-base-content/50 text-xs">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
            <div class="flex gap-6">
                @if($siteSettings->facebook_url)
                    <a href="{{ $siteSettings->facebook_url }}" class="text-base-content/50 hover:text-primary transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                    </a>
                @endif
                @if($siteSettings->instagram_url)
                    <a href="{{ $siteSettings->instagram_url }}" class="text-base-content/50 hover:text-primary transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.774 4.919 4.851.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.075-1.667 4.703-4.919 4.85-.126.059-1.646.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.252-.148-4.771-1.774-4.919-4.851-.058-1.265-.069-1.645-.069-4.849 0-3.205.012-3.584.069-4.849.149-3.075 1.667-4.703 4.919-4.85.126-.059 1.646-.069 4.85-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>