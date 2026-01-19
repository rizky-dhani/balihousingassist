## ADDED Requirements

### Requirement: Header displays site logo
The `resources/views/components/header.blade.php` Blade view MUST display the site logo retrieved from the `SiteSetting` model.
#### Scenario: Logo rendering
An `<img>` tag with the site logo's URL from `SiteSetting::get()->getFirstMediaUrl('logo')` MUST be present in the header.
#### Scenario: Fallback for missing logo
If no logo is set in `SiteSetting`, a fallback (e.g., site name from `config('app.name')`) MUST be displayed.

### Requirement: Footer displays site logo
The `resources/views/components/footer.blade.php` Blade view MUST display the site logo retrieved from the `SiteSetting` model.
#### Scenario: Logo rendering
An `<img>` tag with the site logo's URL from `SiteSetting::get()->getFirstMediaUrl('logo')` MUST be present in the footer.
#### Scenario: Fallback for missing logo
If no logo is set in `SiteSetting`, a fallback (e.g., site name from `config('app.name')`) MUST be displayed.
