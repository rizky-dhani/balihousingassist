# Integrate Site Logo into Header and Footer Blade Views - Tasks

This document outlines the tasks required to integrate the site logo from the `SiteSetting` resource into the header and footer Blade views.

## Tasks

- [x] **Task 1: Ensure SiteSetting Model is Accessible**
    - **Description:** Verify that the `SiteSetting` model and its singleton access method (e.g., `SiteSetting::get()`) are readily available for use in Blade views or view composers.
    - **Verification:** Use `tinker` or a temporary route to confirm that `SiteSetting::get()->getFirstMediaUrl('logo')` returns a valid URL (or empty string/null) when a logo is present/absent.
    - **Depends on:** `add-site-setting-filament-resource` completion

- [x] **Task 2: Modify Header Blade View to Display Logo**
    - **Description:** Edit `resources/views/components/header.blade.php` to include an `<img>` tag that displays the site logo retrieved from the `SiteSetting` model. Include a fallback or conditional rendering if no logo is set.
    - **Verification:** Render a page that includes the header and visually confirm the logo is displayed correctly, or a fallback is shown if no logo is set.
    - **Depends on:** Task 1

- [x] **Task 3: Modify Footer Blade View to Display Logo**
    - **Description:** Edit `resources/views/components/footer.blade.php` to include an `<img>` tag that displays the site logo retrieved from the `SiteSetting` model. Include a fallback or conditional rendering if no logo is set.
    - **Verification:** Render a page that includes the footer and visually confirm the logo is displayed correctly, or a fallback is shown if no logo is set.
    - **Depends on:** Task 1

- [x] **Task 4: Create/Update Feature Test for Logo Presence in Header**
    - **Description:** Create a new feature test or update an existing one to assert that the site logo `<img>` tag (with correct `src`) is present in the rendered HTML of a page that includes the header.
    - **Verification:** Run the feature test and ensure it passes.
    - **Depends on:** Task 2

- [x] **Task 5: Create/Update Feature Test for Logo Presence in Footer**
    - **Description:** Create a new feature test or update an existing one to assert that the site logo `<img>` tag (with correct `src`) is present in the rendered HTML of a page that includes the footer.
    - **Verification:** Run the feature test and ensure it passes.
    - **Depends on:** Task 3