# Design for Integrating Property Features

## 1. PropertyCategory Integration

### Architectural Reasoning

The `Property` model already contains a `property_category_id` field and a `belongsTo` relationship to `PropertyCategory`. This design supports a many-to-one relationship where multiple properties can belong to a single category. The `PropertyCategory` model will primarily consist of a `name` and a `slug` for easy identification and URL generation.

### Details

-   **Model**: `App\Models\PropertyCategory` with `name` and `slug` attributes.
-   **Migration**: `property_categories` table with `id`, `name`, `slug` (unique), `created_at`, `updated_at`.
-   **Filament Resource**: `App\Filament\Resources\PropertyCategoryResource` for CRUD operations on categories within the Filament admin panel.
-   **PropertyForm**: A `Select` field in `PropertyForm` will allow users to choose an existing `PropertyCategory` for a `Property`.

## 2. PropertyLocation Implementation

### Architectural Reasoning

The current `location` and `address` fields in the `Property` model are simple strings, which are inadequate for advanced location-based features (e.g., mapping, proximity search). A dedicated `PropertyLocation` model provides a structured way to store precise location data and allows for future expansion (e.g., geocoding, multiple locations per property). A one-to-one relationship between `Property` and `PropertyLocation` is chosen initially, with `PropertyLocation` owning the foreign key `property_id`. This keeps location details separate but directly linked to a property.

### Details

-   **Model**: `App\Models\PropertyLocation`.
    -   `property_id` (foreign key to `properties` table).
    -   `latitude` (float).
    -   `longitude` (float).
    -   `address_line_1` (string).
    -   `address_line_2` (string, nullable).
    -   `city` (string).
    -   `state` (string, nullable).
    -   `zip_code` (string, nullable).
    -   `country` (string).
-   **Migration**: `property_locations` table with corresponding fields and a `unique` constraint on `property_id`.
-   **Relationship**: `Property` model will have a `hasOne` relationship to `PropertyLocation`. `PropertyLocation` will have a `belongsTo` relationship to `Property`.
-   **Filament Resource**: `App\Filament\Resources\PropertyLocationResource` for managing location details, accessible as a sub-navigation item under the "Property" resource within the "Properties" navigation group.
-   **PropertyForm Update**: The existing `location` and `address` fields in `PropertyForm` will be removed. Property location management will be handled directly through the `PropertyLocationResource` or via a relation manager from the `PropertyResource`.
