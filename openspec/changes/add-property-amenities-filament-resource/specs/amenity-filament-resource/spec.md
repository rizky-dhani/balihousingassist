## ADDED Requirements

### Requirement: Amenity Filament resource created
A new Filament resource named `AmenityResource` MUST be created in `app/Filament/Resources`.
#### Scenario: Resource linked to model
The `AmenityResource` MUST be linked to the `App\Models\Amenity` model.

### Requirement: Amenity resource form fields defined
The `form` method within `AmenityResource` MUST define the following fields:
#### Scenario: Name field
A `TextInput` field for `name` that is required and unique.

### Requirement: Amenity resource table columns defined
The `table` method within `AmenityResource` MUST define the following columns:
#### Scenario: Name column
A `TextColumn` for `name` that is searchable and sortable.
