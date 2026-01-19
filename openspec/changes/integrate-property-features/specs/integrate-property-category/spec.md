## ADDED Requirements

### Requirement: PropertyCategory Model Definition
A new Eloquent model, `PropertyCategory`, MUST be created in `app/Models/PropertyCategory.php`. It MUST include `name` and `slug` attributes, and implement the `HasFactory` trait.

#### Scenario: Basic Model Structure
The `PropertyCategory` model MUST define `name` and `slug` as mass assignable attributes in the `$fillable` array.

#### Scenario: Slug Generation on Creation
The `PropertyCategory` model MUST automatically generate a unique `slug` from its `name` when a new record is created.

#### Scenario: Slug Update on Name Change
The `PropertyCategory` model MUST update its `slug` if the `name` attribute is changed.

### Requirement: PropertyCategory Database Migration
A database migration MUST be created to establish a `property_categories` table.

#### Scenario: Table Structure
The `property_categories` table MUST include:
- An auto-incrementing primary key `id`.
- A string column `name` that is required.
- A unique string column `slug` that is required.
- `timestamps` columns (`created_at`, `updated_at`).

### Requirement: PropertyCategory Filament Resource
A new Filament resource, `PropertyCategoryResource`, MUST be created in `app/Filament/Resources/PropertyCategoryResource.php`.

#### Scenario: Resource Definition
The `PropertyCategoryResource` MUST be configured to manage `PropertyCategory` records, including forms for creating and editing, and a table for listing.

#### Scenario: Navigation Icon
The `PropertyCategoryResource` navigation MUST use `Heroicon::OutlinedTag` as its icon.

#### Scenario: Form Schema
The `PropertyCategoryResource` form MUST include:
- A `TextInput` for `name` that is required, unique, and automatically updates the `slug` field.
- A `TextInput` for `slug` that is required, unique, and disabled.

#### Scenario: Table Columns
The `PropertyCategoryResource` table MUST display:
- The `name` of the category.
- The `slug` of the category.
- `created_at` and `updated_at` timestamps.

#### Scenario: Navigation Group and Sort Order
The `PropertyCategoryResource` MUST be placed under the "Properties" navigation group and have a sort order that places it logically within that group (e.g., after the main Property resource).

#### Scenario: Navigation Label
The `PropertyCategoryResource` navigation label MUST be "Categories".

### MODIFIED Requirements

### Requirement: Property Model Relationship Confirmation
The `Property` Eloquent model MUST maintain its `belongsTo` relationship with the `PropertyCategory` model via the `property_category_id` foreign key.

#### Scenario: Relationship Method
The `category()` method in `App\Models\Property.php` MUST correctly define the `belongsTo` relationship to `PropertyCategory::class` using `property_category_id`.
