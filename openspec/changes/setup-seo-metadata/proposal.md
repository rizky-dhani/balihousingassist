# Proposal: Setup SEO Metadata (RalphJSmit)

## Problem
The Bali Housing Assist application currently lacks SEO metadata (meta tags, OpenGraph, Twitter cards). We need a scalable, automated way to manage SEO across properties and future resources.

## Solution
Implement SEO using `ralphjsmit/laravel-seo`. This package uses a polymorphic relationship to store SEO data in a dedicated table, keeping our business models clean. We will also use the companion Filament plugin for instant admin integration.

## Scope
- Install `ralphjsmit/laravel-seo` and `ralphjsmit/laravel-filament-seo`.
- Run migrations for the dedicated `seo` table.
- Integrate the `HasSEO` trait into the `Property` model.
- Update the main layout to render the SEO component.
- Configure automatic fallbacks (e.g., use Property name as title if SEO title is empty).
- Add the SEO field group to the `PropertyResource` in Filament.
