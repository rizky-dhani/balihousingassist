# Integrate Site Logo into Header and Footer Blade Views - Design

## Context
This design assumes the `SiteSetting` Filament resource has been successfully implemented and a `SiteSetting` model exists, which utilizes `spatie/laravel-medialibrary` for handling logo uploads. It also assumes that `resources/views/components/header.blade.php` and `resources/views/components/footer.blade.php` are the target Blade views.

## Site Logo Retrieval
The site logo will be retrieved using the `SiteSetting` model's singleton access method and `spatie/laravel-medialibrary`'s `getFirstMediaUrl()` method.

```php
// Example retrieval
$siteSettings = \App\Models\SiteSetting::get(); // Assuming a get() static method for singleton
$logoUrl = $siteSettings->getFirstMediaUrl('logo_collection_name'); // 'logo_collection_name' will be defined in SiteSetting model
```
A default image or conditional rendering will be implemented to handle cases where no logo has been uploaded.

## Header Integration (`resources/views/components/header.blade.php`)
The header Blade view will be modified to include an `<img>` tag. The `src` attribute of this tag will be dynamically populated with the `logoUrl` retrieved from `SiteSetting`.

```blade
<header>
    @php
        $siteSettings = \App\Models\SiteSetting::get();
        $logoUrl = $siteSettings->getFirstMediaUrl('logo'); // Assuming 'logo' as media collection name
    @endphp

    @if ($logoUrl)
        <a href="/">
            <img src="{{ $logoUrl }}" alt="Site Logo">
        </a>
    @else
        <!-- Fallback or site name display -->
        <a href="/">{{ config('app.name') }}</a>
    @endif
    <!-- Other header content -->
</header>
```

## Footer Integration (`resources/views/components/footer.blade.php`)
Similarly, the footer Blade view will be modified to include an `<img>` tag.

```blade
<footer>
    @php
        $siteSettings = \App\Models\SiteSetting::get();
        $logoUrl = $siteSettings->getFirstMediaUrl('logo'); // Assuming 'logo' as media collection name
    @endphp

    @if ($logoUrl)
        <a href="/">
            <img src="{{ $logoUrl }}" alt="Site Logo">
        </a>
    @else
        <!-- Fallback or site name display -->
        <a href="/">{{ config('app.name') }}</a>
    @endif
    <!-- Other footer content -->
</footer>
```

## Considerations
- **Media Collection Name**: A consistent media collection name (e.g., `'logo'`) will be used for the site logo in the `SiteSetting` model.
- **Styling**: The `<img>` tags for the logo will need appropriate CSS classes or inline styles to ensure correct display and responsiveness within the header and footer layouts. This is outside the direct scope of this proposal but is a necessary follow-up.
- **Caching**: Consider caching the `SiteSetting` retrieval to optimize performance, as these settings will be accessed on almost every page load.