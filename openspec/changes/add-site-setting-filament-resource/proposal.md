# Add SiteSetting Filament Resource

## Overview
This proposal outlines the creation of a Filament resource named `SiteSetting` to allow users to manage global website settings. These settings will include, but are not limited to, the site logo, and social media icons and their corresponding URLs. The `SiteSetting` will likely follow a singleton pattern, meaning there will be only one record in the database for these global settings.

## Motivation
Currently, managing global site-wide settings such as branding elements or social media links might require direct code modifications. This proposal aims to provide a user-friendly interface through Filament for non-technical users to update these crucial aspects of the website, enhancing content management flexibility and reducing development overhead for minor content changes.

## Scope
This proposal covers the following aspects:
- Creation of a `SiteSetting` Eloquent model.
- Creation of a database migration for a `site_settings` table to store various site configurations.
- Creation of a Filament resource (`SiteSettingResource`) that provides an interface to view and edit these settings.
- Initial fields will include a site logo (image upload), and several social media fields (e.g., Facebook, Twitter, Instagram, LinkedIn) each with an icon/name and URL.

## High-Level Plan
1. Create the `SiteSetting` model.
2. Create the `site_settings` table migration with appropriate fields for site logo and social media links.
3. Create the `SiteSettingResource` for Filament, defining its form schema and table (or single view) definitions.
4. Implement a singleton pattern for the `SiteSetting` model to ensure only one record exists.

## Dependencies
- Laravel application with Filament installed and configured.
- Database connection for migration.
- `spatie/laravel-medialibrary` for handling image uploads (site logo).
