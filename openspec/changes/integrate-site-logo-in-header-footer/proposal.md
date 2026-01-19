# Integrate Site Logo into Header and Footer Blade Views

## Overview
This proposal details the modification of the existing header and footer Blade views (`resources/views/components/header.blade.php` and `resources/views/components/footer.blade.php`) to dynamically display the site logo managed through the `SiteSetting` Filament resource.

## Motivation
Centralizing the site logo management via the `SiteSetting` resource allows administrators to update the logo without direct code changes, ensuring consistency across the site and improving content flexibility. Integrating this dynamic logo into the header and footer ensures that these key visual elements always reflect the current branding.

## Scope
This proposal covers:
- Modifying `resources/views/components/header.blade.php` to fetch and display the site logo from the `SiteSetting` model.
- Modifying `resources/views/components/footer.blade.php` to fetch and display the site logo from the `SiteSetting` model.
- It assumes the `SiteSetting` Filament resource (including the logo upload functionality via `spatie/laravel-medialibrary`) has been implemented as per the `add-site-setting-filament-resource` proposal.
- This proposal does NOT cover the creation or modification of the `SiteSetting` model or Filament resource itself, nor does it address styling of the logo beyond basic display.

## High-Level Plan
1. Retrieve the single `SiteSetting` record (or create it if it doesn't exist).
2. Access the site logo media collection from the `SiteSetting` model.
3. Integrate an `<img>` tag with the logo's URL into `resources/views/components/header.blade.php`.
4. Integrate an `<img>` tag with the logo's URL into `resources/views/components/footer.blade.php`.

## Dependencies
- The `SiteSetting` model and its associated migration and Filament resource are implemented and functional (`add-site-setting-filament-resource` change is completed).
- `spatie/laravel-medialibrary` is correctly configured for `SiteSetting` to handle logo uploads.
- Existing `resources/views/components/header.blade.php` and `resources/views/components/footer.blade.php` files.
