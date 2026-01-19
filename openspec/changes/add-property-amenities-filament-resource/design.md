# Add Property Amenities and Bedroom/Bathroom Fields - Design

## Data Models

### `Amenity` Model (`app/Models/Amenity.php`)
- Extends `Illuminate\Database\Eloquent\Model`.
- Will have a `name` string field.
- Will define a `belongsToMany` relationship to `Property`.

### `Property` Model (`app/Models/Property.php`)
- Assumed to exist.
- Will have new integer `bedroom` and decimal `bathroom` fields.
- Will define a `belongsToMany` relationship to `Amenity`.

## Database Migrations

### `amenities` Table
A new migration will create an `amenities` table with:
- `id` (primary key)
- `name` (string, unique)
- `created_at`, `updated_at` (timestamps)

### `property_amenity` Pivot Table
A new migration will create a `property_amenity` pivot table for the many-to-many relationship:
- `property_id` (foreign key to `properties` table)
- `amenity_id` (foreign key to `amenities` table)
- Combined primary key on `property_id` and `amenity_id`.

### `properties` Table Modification
An existing migration (or a new one if modifying an existing field) will add:
- `bedroom` (integer, nullable, default 0)
- `bathroom` (decimal, nullable, default 0.0)

## Filament Resources

### `AmenityResource` (`app/Filament/Resources/AmenityResource.php`)
- **Form**: `TextInput::make('name')->required()->unique()`.
- **Table**: `TextColumn::make('name')->sortable()->searchable()`.

### `PropertyResource` (`app/Filament/Resources/PropertyResource.php`)
- Assumed to exist.
- **Form**:
    - `TextInput::make('bedroom')->numeric()->default(0)`.
    - `TextInput::make('bathroom')->numeric()->step(0.5)->default(0.0)`.
    - `CheckboxList::make('amenities')
        ->relationship('amenities', 'name')
        ->columns(2)
        ->helperText('Select all applicable amenities.')`.
- **Table**:
    - `TextColumn::make('bedroom')->sortable()`.
    - `TextColumn::make('bathroom')->sortable()`.
    - Optionally, `SpatieTagsColumn::make('amenities.name')` or a custom column to display selected amenities.

## Resource Nesting
The `Amenity` resource will be nested under the `Property` resource using a `RelationManager`. This means that when viewing or editing a `Property` in Filament, there will be a section or tab to manage its associated amenities directly.

## User Experience
- Administrators can create and manage a global list of amenities via the `AmenityResource`.
- When editing a `Property`, administrators can specify the number of bedrooms and bathrooms, and select multiple amenities from a checklist.
- The `AmenityRelationManager` will allow managing amenities directly from a `Property` edit page.