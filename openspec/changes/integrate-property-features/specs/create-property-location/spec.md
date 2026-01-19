## ADDED Requirements

### Requirement: PropertyLocation Model Definition
A new Eloquent model, `PropertyLocation`, MUST be created in `app/Models/PropertyLocation.php`. It MUST store detailed geographic and address information for a property.

#### Scenario: Model Attributes
The `PropertyLocation` model MUST define the following attributes as mass assignable:
- `property_id` (foreign key to `properties` table).
- `latitude` (float, nullable).
- `longitude` (float, nullable).
- `address_line_1` (string, required).
- `address_line_2` (string, nullable).
- `city` (string, required).
- `state` (string, nullable).
- `zip_code` (string, nullable).
- `country` (string, required, with a default value, e.g., 'Indonesia').

#### Scenario: `HasFactory` Trait
The `PropertyLocation` model MUST use the `HasFactory` trait.

### Requirement: PropertyLocation Database Migration
A database migration MUST be created to establish a `property_locations` table.

#### Scenario: Table Structure
The `property_locations` table MUST include:
- An auto-incrementing primary key `id`.
- An unsigned big integer `property_id` that is a foreign key to the `properties` table, with cascading onDelete.
- A float column `latitude` that is nullable.
- A float column `longitude` that is nullable.
- A string column `address_line_1` that is required.
- A string column `address_line_2` that is nullable.
- A string column `city` that is required.
- A string column `state` that is nullable.
- A string column `zip_code` that is nullable.
- A string column `country` that is required, with a default value.
- `timestamps` columns (`created_at`, `updated_at`).
- A unique constraint on `property_id`.

### Requirement: Property Model Relationship to PropertyLocation
The `App\Models\Property` Eloquent model MUST define a one-to-one relationship with `PropertyLocation`.

#### Scenario: Relationship Definition
The `Property` model MUST include a `location()` method that returns a `hasOne` relationship to `PropertyLocation::class`.

### Requirement: PropertyLocation Filament Resource
A new Filament resource, `PropertyLocationResource`, MUST be created in `app/Filament/Resources/PropertyLocationResource.php`.

#### Scenario: Resource Definition
The `PropertyLocationResource` MUST be configured to manage `PropertyLocation` records, including forms for creating and editing, and a table for listing.

#### Scenario: Navigation Group and Sort Order
The `PropertyLocationResource` MUST be placed under the "Properties" navigation group and have a sort order that places it logically within that group.

#### Scenario: Form Schema
The `PropertyLocationResource` form MUST include:
- `TextInput` for `address_line_1`, `address_line_2`, `city`, `state`, `zip_code`, `country`.
- `TextInput` for `latitude` and `longitude`.

#### Scenario: Table Columns
The `PropertyLocationResource` table MUST display:
- `address_line_1`, `city`, `state`, `country`.
- `latitude` and `longitude`.
- `created_at` and `updated_at` timestamps.

#### Scenario: Navigation Icon
The `PropertyLocationResource` navigation MUST use `Heroicon::OutlinedMapPin` as its icon.

#### Scenario: Navigation Label
The `PropertyLocationResource` navigation label MUST be "Locations".


### MODIFIED Requirement: PropertyForm Location Management
The PropertyForm MUST provide a mechanism to manage the associated PropertyLocation.

#### Scenario: Location Relation Manager
The PropertyResource MUST include a RelationManager for PropertyLocation, allowing the creation, editing, and viewing of a Property's location directly from the Property edit page.

## MODIFIED Requirements

### Requirement: Remove Redundant Location Fields from Property
The `App\Models\Property` model and `App\Filament\Resources\Properties\Schemas\PropertyForm` MUST remove redundant location fields.

#### Scenario: Model Fillable Update
The `location` and `address` fields MUST be removed from the `$fillable` array of the `Property` model.

#### Scenario: Form Field Removal
The `TextInput` fields for `location` and `address` MUST be removed from `PropertyForm`.
