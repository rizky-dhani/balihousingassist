## ADDED Requirements

### Requirement: SiteSetting model created
The application MUST include an Eloquent model named `SiteSetting` in `app/Models`.
#### Scenario: Model structure
The `SiteSetting` model MUST extend `Illuminate\Database\Eloquent\Model` and use the `Spatie\MediaLibrary\HasMedia` and `Spatie\MediaLibrary\InteractsWithMedia` traits.

### Requirement: SiteSetting migration created and applied
A new database migration MUST be created for a `site_settings` table.
#### Scenario: Table columns
The `site_settings` table MUST include the following columns:
- `id` (primary key)
- `facebook_url` (string, nullable)
- `twitter_url` (string, nullable)
- `instagram_url` (string, nullable)
- `linkedin_url` (string, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Requirement: Filament SiteSetting resource created
A new Filament resource named `SiteSettingResource` MUST be created in `app/Filament/Resources`.
#### Scenario: Resource linked to model
The `SiteSettingResource` MUST be linked to the `App\Models\SiteSetting` model.

### Requirement: SiteSetting resource form fields defined
The `form` method within `SiteSettingResource` MUST define the following fields:
#### Scenario: Site Logo field
A `FileUpload` field for the site logo, configured to use `spatie/laravel-medialibrary`.
#### Scenario: Social Media URL fields
`TextInput` fields for `facebook_url`, `twitter_url`, `instagram_url`, and `linkedin_url`. These fields MUST be nullable and include URL validation.

### Requirement: SiteSetting singleton pattern enforced
The `SiteSetting` model or its associated logic MUST ensure that only a single record exists in the `site_settings` table.
#### Scenario: Single record retrieval
When `SiteSetting` is accessed, it MUST always return the single existing record, creating one if it doesn't exist.
#### Scenario: Preventing multiple records
Attempts to create additional `SiteSetting` records MUST be prevented or result in the update of the existing single record.
