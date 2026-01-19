## ADDED Requirements

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

### Requirement: SiteSetting resource table/view behavior
The `SiteSettingResource` MUST provide an interface to manage the single `SiteSetting` record.
#### Scenario: Index page redirection
The `index` page of the `SiteSettingResource` MUST redirect directly to the `edit` page of the single `SiteSetting` record.
