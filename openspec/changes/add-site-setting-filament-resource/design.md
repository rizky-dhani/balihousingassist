# Add SiteSetting Filament Resource - Design

## Data Model
The `SiteSetting` model will primarily serve as a singleton to store global configuration data.

### `SiteSetting` Model (`app/Models/SiteSetting.php`)
- Will extend `Illuminate\Database\Eloquent\Model`.
- Will use `Spatie\MediaLibrary\HasMedia` and `Spatie\MediaLibrary\InteractsWithMedia` traits to handle the site logo.
- Will likely include a method to ensure only one record exists, potentially overriding `create` or using a custom `getSingleton()` method.

### `site_settings` Table Migration
The `site_settings` table will store various configurations. Initially, it will include:
- `id` (primary key)
- `facebook_url` (string, nullable)
- `twitter_url` (string, nullable)
- `instagram_url` (string, nullable)
- `linkedin_url` (string, nullable)
- `created_at`, `updated_at` (timestamps)
Consideration for a `jsonb` column (e.g., `settings`) will be made for more flexible, unstructured settings in the future, but for this proposal, specific columns will be used.

## Filament Resource Structure (`app/Filament/Resources/SiteSettingResource.php`)
The `SiteSettingResource` will be designed for single-record management.

### Form
The form will be structured into sections for better organization:
- **General Settings**:
    - `FileUpload::make('logo')`: To upload and manage the site logo. This will utilize the `spatie/laravel-medialibrary` package.
- **Social Media Links**:
    - `TextInput::make('facebook_url')`: For the Facebook profile URL.
    - `TextInput::make('twitter_url')`: For the Twitter profile URL.
    - `TextInput::make('instagram_url')`: For the Instagram profile URL.
    - `TextInput::make('linkedin_url')`: For the LinkedIn profile URL.
All URL fields will have appropriate validation (e.g., `url` rule).

### Table/View
Given the singleton nature, the resource will likely present a single entry for editing rather than a list. The `index` page of the resource might redirect directly to the `edit` page of the single `SiteSetting` record.

## Singleton Pattern
The `SiteSetting` model will enforce a singleton pattern. This can be achieved by:
- Overriding the `boot` method in the model to create a record if none exists.
- Implementing a static `get()` method to retrieve the single record, creating it if necessary.
- Potentially using a Filament global page instead of a resource if a list view is not required at all. However, starting with a resource provides more flexibility.

## User Experience
Administrators will navigate to the `SiteSetting` resource in Filament and will be presented with a form to update the site logo, social media links, and other configurable aspects of the website. Changes will be saved to the single `site_settings` database record.