<section class="bg-base-100 py-8 lg:py-12 px-4 lg:px-8">
    <div class="max-w-screen-xl mx-auto">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <div class="h-9 w-64 bg-base-200 rounded animate-pulse mb-2"></div>
                <div class="h-5 w-96 bg-base-200 rounded animate-pulse"></div>
            </div>
            <div class="flex items-center gap-2">
                <div class="h-5 w-16 bg-base-200 rounded animate-pulse"></div>
                <div class="h-8 w-40 bg-base-200 rounded animate-pulse"></div>
            </div>
        </div>

        <div class="bg-base-200 h-16 rounded-2xl mb-12 animate-pulse"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach(range(1, 8) as $i)
                <x-property-skeleton />
            @endforeach
        </div>
    </div>
</section>
