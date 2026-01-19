# Add Property Amenities and Bedroom/Bathroom Fields - Tasks

This document outlines the tasks required to implement property amenities and bedroom/bathroom fields.

## Tasks

- [x] **Task 1: Create Amenity Model**
    - **Description:** Create the `app/Models/Amenity.php` Eloquent model.
    - **Verification:** Ensure the model exists and extends `Illuminate\Database\Eloquent\Model`.
    - **Depends on:** None

- [x] **Task 2: Create Amenity Migration**
    - **Description:** Generate and define the migration for the `amenities` table with `id`, `name` (string), `created_at`, `updated_at` columns.
    - **Verification:** Run `php artisan migrate:status` to confirm the migration is pending, then `php artisan migrate` and verify the table structure.
    - **Depends on:** Task 1

- [x] **Task 3: Create Property Amenity Pivot Table Migration**
    - **Description:** Generate and define the migration for the `property_amenity` pivot table with `property_id` and `amenity_id` columns, and appropriate foreign key constraints.
    - **Verification:** Run `php artisan migrate:status` to confirm the migration is pending, then `php artisan migrate` and verify the table structure.
    - **Depends on:** Task 2

- [x] **Task 4: Modify Property Model**
    - **Description:** Modify `app/Models/Property.php` to add `bedroom` and `bathroom` fillable attributes. Define a `belongsToMany` relationship to the `Amenity` model.
    - **Verification:** Write unit tests to confirm `bedroom`, `bathroom` are fillable and the `amenities` relationship works correctly.
    - **Depends on:** Task 1, Task 3

- [x] **Task 5: Modify Properties Table Migration**
    - **Description:** Add `bedroom` (integer, nullable, default 0) and `bathroom` (decimal, nullable, default 0) columns to the `properties` table.
    - **Verification:** Run `php artisan migrate:status` to confirm the migration is pending, then `php artisan migrate` and verify the table structure.
    - **Depends on:** Task 4

- [x] **Task 6: Create Amenity Filament Resource**
    - **Description:** Generate the Filament resource for the `Amenity` model.
    - **Verification:** Ensure the resource file `app/Filament/Resources/AmenityResource.php` exists.
    - **Depends on:** Task 1

- [x] **Task 7: Implement Amenity Resource Form and Table**
    - **Description:** Define the form schema (e.g., `TextInput` for `name`) and table columns (e.g., `TextColumn` for `name`) for `AmenityResource`.
    - **Verification:** Navigate to the Filament admin panel, open the Amenity resource, and verify form and table functionality.
    - **Depends on:** Task 6

- [x] **Task 8: Modify Property Filament Resource Form**
    - **Description:** Add `TextInput` fields for `bedroom` and `bathroom` to the `PropertyResource` form. Add a `CheckboxList` field for selecting associated `Amenity` items.
    - **Verification:** Navigate to the Filament admin panel, open the Property resource, and verify the new fields and checkbox list are displayed and functional.
    - **Depends on:** Task 4, Task 7

- [x] **Task 9: Modify Property Filament Resource Table**
    - **Description:** Add `TextColumn` fields for `bedroom` and `bathroom` to the `PropertyResource` table. Optionally, display selected amenities (e.g., via a `SpatieTagsColumn` or a custom column).
    - **Verification:** Navigate to the Filament admin panel, open the Property resource, and verify the new columns are displayed correctly.
    - **Depends on:** Task 8

- [x] **Task 10: Nest Amenity Resource under Property Resource**
    - **Description:** Configure Filament to nest `AmenityResource` under `PropertyResource` (e.g., using a `RelationManager`).
    - **Verification:** Navigate to a `Property` edit page in Filament and confirm that the `Amenity` RelationManager is accessible and functional.
    - **Depends on:** Task 7, Task 8

- [x] **Task 11: Create Feature Test for Property Amenity Relationship**
    - **Description:** Create a feature test to verify that properties can be associated with amenities, and that these associations are correctly saved and retrieved through the Filament interface.
    - **Verification:** Run the feature test and ensure it passes.
    - **Depends on:** Task 10
