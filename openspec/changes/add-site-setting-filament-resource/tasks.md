# Add SiteSetting Filament Resource - Tasks

This document outlines the tasks required to implement the `SiteSetting` Filament resource.

## Tasks

- [x] **Task 1: Create SiteSetting Model**
    - **Description:** Create the `app/Models/SiteSetting.php` Eloquent model.
    - **Verification:** Ensure the model exists and extends `Illuminate\Database\Eloquent\Model`. Add the `HasMedia` and `InteractsWithMedia` traits from `spatie/laravel-medialibrary`.
    - **Depends on:** `spatie/laravel-medialibrary` package installation (already completed).

- [x] **Task 2: Create SiteSetting Migration**
    - **Description:** Generate and define the migration for the `site_settings` table. Initial fields will include:
        - `id` (primary key)
        - `created_at` (timestamp)
        - `updated_at` (timestamp)
        - `facebook_url` (string, nullable)
        - `twitter_url` (string, nullable)
        - `instagram_url` (string, nullable)
        - `linkedin_url` (string, nullable)
        - Other generic settings as JSON (e.g., `settings` jsonb, nullable).
    - **Verification:** Run `php artisan migrate:status` to confirm the migration is pending, then `php artisan migrate` and verify the table structure.
    - **Depends on:** Task 1

- [x] **Task 3: Create Filament SiteSetting Resource**
    - **Description:** Generate the Filament resource for the `SiteSetting` model.
    - **Verification:** Ensure the resource file `app/Filament/Resources/SiteSettingResource.php` exists.
    - **Depends on:** Task 1

- [x] **Task 4: Implement SiteSetting Resource Form**
    - **Description:** Define the form schema for `SiteSettingResource`. This will include:
        - A `FileUpload` field for the site logo (using `spatie/laravel-medialibrary`).
        - `TextInput` fields for each social media URL (Facebook, Twitter, Instagram, LinkedIn).
        - A `KeyValue` field or `Repeater` for other generic settings (if `settings` JSON column is used).
    - **Verification:** Navigate to the Filament admin panel, open the SiteSetting resource, and verify the form fields are correctly displayed and functional.
    - **Depends on:** Task 3

- [x] **Task 5: Implement SiteSetting Resource Table/View**
    - **Description:** Define how the `SiteSetting` data will be displayed. Given it's a singleton, it might be a single "edit" view rather than a list table.
    - **Verification:** Verify the resource displays the single site settings entry correctly.
    - **Depends on:** Task 3

- [x] **Task 6: Implement SiteSetting Singleton Logic**
    - **Description:** Add logic to the `SiteSetting` model or resource to ensure only a single record exists and is always retrieved/created.
    - **Verification:** Attempt to create multiple `SiteSetting` records through the Filament interface or directly, and ensure only one persists.
    - **Depends on:** Task 1, Task 2

- [x] **Task 7: Create Feature Test for SiteSetting Resource**
    - **Description:** Create a feature test to verify CRUD operations (specifically, update) for the `SiteSetting` resource through the Filament interface, and to verify the singleton behavior.
    - **Verification:** Run the feature test and ensure it passes.
    - **Depends on:** Task 4, Task 5, Task 6