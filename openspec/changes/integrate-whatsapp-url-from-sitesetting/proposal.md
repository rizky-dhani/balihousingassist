# Integrate WhatsApp URL from SiteSetting to "Book Now" button on Property Card

## Overview
This proposal outlines the integration of the WhatsApp contact URL, retrieved from the `SiteSetting` resource, into the "Book Now" button present on each property card in the "Our Property Catalog" section. This will ensure that the WhatsApp contact link is centrally managed and dynamically updated across all property cards.

## Motivation
Previously, the "Book Now" WhatsApp button was implemented with an assumed WhatsApp number. By fetching this number from the `SiteSetting` resource, we centralize its management, allowing non-technical users to easily update the contact number without code changes. This improves maintainability and ensures that all property inquiries are directed to the correct, up-to-date WhatsApp contact.

## Scope
This proposal covers:
- Retrieving the WhatsApp URL (or just the number) from the `SiteSetting` model.
- Modifying `resources/views/components/single-property.blade.php` to use this dynamically retrieved WhatsApp URL for the "Book Now" button's `href` attribute.
- It assumes:
    - The `add-site-setting-filament-resource` proposal has been implemented, and the `SiteSetting` model includes a field for a WhatsApp number/URL. For this proposal, I will assume a `whatsapp_number` field exists in `SiteSetting`.
    - The `implement-property-card-whatsapp` proposal has been implemented, and `resources/views/components/single-property.blade.php` contains the "Book Now" button.
- This proposal does NOT cover the creation or modification of the `SiteSetting` model/resource itself, nor the creation of the property card component.

## High-Level Plan
1. Ensure the `SiteSetting` model contains a field for the WhatsApp number/URL.
2. Retrieve the `SiteSetting` record.
3. Access the `whatsapp_number` from the `SiteSetting` record.
4. Update the `href` attribute of the "Book Now" button in `resources/views/components/single-property.blade.php` to use the dynamically retrieved WhatsApp number/URL.

## Dependencies
- The `SiteSetting` model and its associated migration and Filament resource are implemented and functional (`add-site-setting-filament-resource` change is completed and includes a `whatsapp_number` field).
- The `implement-property-card-whatsapp` change is completed, meaning `resources/views/components/single-property.blade.php` exists and contains the "Book Now" button.
