# Integrate WhatsApp URL from SiteSetting to "Book Now" button on Property Card - Tasks

This document outlines the tasks required to integrate the WhatsApp URL from `SiteSetting` into the "Book Now" button.

## Tasks

- [x] **Task 1: Confirm `whatsapp_number` Field in SiteSetting**
    - **Description:** Verify that the `SiteSetting` model and its corresponding database table (`site_settings`) include a `whatsapp_number` field. If not, this needs to be added as a prerequisite.
    - **Verification:** Inspect the `site_settings` migration and `SiteSetting` model.
    - **Depends on:** `add-site-setting-filament-resource` completion (specifically, that it supports a `whatsapp_number` field).

- [x] **Task 2: Ensure SiteSetting Model is Accessible in View**
    - **Description:** Verify that the `SiteSetting` model and its singleton access method (e.g., `SiteSetting::get()`) are readily available for use in `single-property.blade.php`, either directly or via a view composer/provider.
    - **Verification:** Use `tinker` or a temporary route to confirm that `SiteSetting::get()->whatsapp_number` returns the expected value.
    - **Depends on:** Task 1

- [x] **Task 3: Modify `single-property.blade.php` to use Dynamic WhatsApp URL**
    - **Description:** Edit `resources/views/components/single-property.blade.php`. Locate the "Book Now" button and update its `href` attribute to dynamically construct the WhatsApp link using the `whatsapp_number` from `SiteSetting` and the property's name.
    - **Verification:** Render a page that includes property cards and visually confirm that the "Book Now" button's link points to the correct WhatsApp URL with the dynamically inserted number and property name.
    - **Depends on:** Task 2, `implement-property-card-whatsapp` completion

- [x] **Task 4: Create/Update Feature Test for Dynamic WhatsApp Link**
    - **Description:** Create a new feature test or update an existing one to assert that the "Book Now" button on property cards generates the correct WhatsApp `href` using the configured `whatsapp_number` from `SiteSetting`.
    - **Verification:** Run the feature test and ensure it passes.
    - **Depends on:** Task 3