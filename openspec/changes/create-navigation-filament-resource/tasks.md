# Create Navigation Filament Resource - Tasks

This document outlines the tasks required to implement the `Navigation` Filament resource.

## Tasks

- [x] **Task 1: Create Navigation Model**
    - **Description:** Create the `app/Models/Navigation.php` Eloquent model.
    - **Verification:** Ensure the model exists and extends `Illuminate\Database\Eloquent\Model`.
    - **Depends on:** None

- [x] **Task 2: Create Navigation Migration**
    - **Description:** Generate and define the migration for the `navigation` table with `id`, `parent_id`, `label`, `url`, `order`, `new_tab`, `created_at`, `updated_at` columns.
    - **Verification:** Run `php artisan migrate:status` to confirm the migration is pending, then `php artisan migrate` and verify the table structure.
    - **Depends on:** Task 1

- [x] **Task 3: Create Filament Navigation Resource**
    - **Description:** Generate the Filament resource for the `Navigation` model.
    - **Verification:** Ensure the resource file `app/Filament/Resources/NavigationResource.php` exists.
    - **Depends on:** Task 1

- [x] **Task 4: Implement Navigation Resource Form**
    - **Description:** Define the form schema for `NavigationResource`, including fields for `label`, `url`, `parent_id` (using a select with `Navigation` items), `order`, and `new_tab` (toggle).
    - **Verification:** Navigate to the Filament admin panel, open the Navigation resource, and verify the form fields are correctly displayed and functional, including the parent-child selection.
    - **Depends on:** Task 3

- [x] **Task 5: Implement Navigation Resource Table**
    - **Description:** Define the table columns for `NavigationResource`, displaying `label`, `url`, `parent` (relation), `order`, and `new_tab`. Implement sorting and searching.
    - **Verification:** Navigate to the Filament admin panel, open the Navigation resource, and verify the table displays navigation items with correct data, sorting, and search functionality.
    - **Depends on:** Task 3

- [x] **Task 6: Define Navigation Model Relationships**
    - **Description:** Add `parent()` and `children()` relationships to the `Navigation` model to support hierarchical navigation.
    - **Verification:** Write unit tests to ensure `parent` and `children` relationships work as expected.
    - **Depends on:** Task 1, Task 2

- [x] **Task 7: Create Feature Test for Navigation Resource**
    - **Description:** Create a feature test to verify CRUD operations for the `Navigation` resource through the Filament interface.
    - **Verification:** Run the feature test and ensure it passes.
    - **Depends on:** Task 4, Task 5, Task 6