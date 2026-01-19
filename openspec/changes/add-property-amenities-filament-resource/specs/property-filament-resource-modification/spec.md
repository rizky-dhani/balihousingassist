## MODIFIED Requirements

### Requirement: Property Filament resource form fields modified
The `form` method within `PropertyResource` MUST be modified to include new fields for bedroom, bathroom, and amenities.
#### Scenario: Bedroom field
A `TextInput` field for `bedroom` that is numeric and defaults to 0.
#### Scenario: Bathroom field
A `TextInput` field for `bathroom` that is numeric, allows decimal values (e.g., step 0.5), and defaults to 0.0.
#### Scenario: Amenities checkbox list
A `CheckboxList` field for `amenities` that allows selecting multiple amenities, sourcing options from the `Amenity` model and managing the `belongsToMany` relationship.

### Requirement: Property Filament resource table columns modified
The `table` method within `PropertyResource` MUST be modified to include new columns for bedroom, bathroom, and amenities.
#### Scenario: Bedroom column
A `TextColumn` for `bedroom` that is sortable.
#### Scenario: Bathroom column
A `TextColumn` for `bathroom` that is sortable.
#### Scenario: Amenities display column
A column (e.g., `SpatieTagsColumn` or `TextColumn` displaying a comma-separated list) to show the associated amenities for each property.

### Requirement: Amenity resource nested under Property resource
The `AmenityResource` MUST be nested under `PropertyResource` in the Filament admin panel.
#### Scenario: Relation Manager
A `RelationManager` for `Amenities` MUST be added to the `PropertyResource` to manage the amenities associated with a specific property.
