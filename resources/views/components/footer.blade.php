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
                        <x-hugeicons-facebook-01/>
                    </a>
                @endif
                @if($siteSettings->instagram_url)
                    <a href="{{ $siteSettings->instagram_url }}" class="text-base-content/50 hover:text-primary transition-colors">
                        <span class="sr-only">Instagram</span>
                        <x-hugeicons-instagram/>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>