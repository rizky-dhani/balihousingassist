## ADDED Requirements

### Requirement: Amenities table migration created and applied
A new database migration MUST be created for an `amenities` table.
#### Scenario: Table columns
The `amenities` table MUST include the following columns:
- `id` (primary key)
- `name` (string, unique)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Requirement: Property amenity pivot table migration created and applied
A new database migration MUST be created for a `property_amenity` pivot table.
#### Scenario: Pivot table columns
The `property_amenity` table MUST include the following columns:
- `property_id` (foreign key to `properties` table)
- `amenity_id` (foreign key to `amenities` table)
- A combined primary key on `property_id` and `amenity_id`.

## MODIFIED Requirements

### Requirement: Properties table migration modified and applied
The `properties` table migration MUST be modified to add `bedroom` and `bathroom` columns.
#### Scenario: Bedroom column
The `properties` table MUST include a `bedroom` column (integer, nullable, default 0).
#### Scenario: Bathroom column
The `properties` table MUST include a `bathroom` column (decimal with precision and scale, nullable, default 0.0).
