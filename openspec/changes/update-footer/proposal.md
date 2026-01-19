# Update Footer

This proposal outlines the changes to update the application's footer section to include "Navigation", "Properties", and "Helpful Links" as per the user's request.

## Problem

The current application does not have a footer component, and the user requires a standardized footer with specific sections and dynamic content.

## Proposed Solution

- **Create a new Blade component** for the footer at `resources/views/components/footer.blade.php`.
- **Implement the "Navigation" section** by creating a new configuration file `config/navigation.php` to define the navigation links, ensuring consistency with the existing header's navigation.
- **Implement the "Properties" section** to display `PropertyCategory` items. This will require the creation of a `PropertyCategory` Eloquent model and a corresponding Filament resource.
- **Implement the "Helpful Links" section** with "Contact Us" linking to the WhatsApp number stored in `SiteSetting`, and a static "FAQs" link.

## Dependencies

- Creation of `PropertyCategory` model and Filament resource (if they don't exist).
- Definition of navigation links in a shared configuration.

## Next Steps

Upon approval, the following tasks will be executed to implement the proposed changes.
