## ADDED Requirements

### Requirement: Amenity model created
The application MUST include an Eloquent model named `Amenity` in `app/Models`.
#### Scenario: Model structure
The `Amenity` model MUST extend `Illuminate\Database\Eloquent\Model` and define a `belongsToMany` relationship with the `Property` model.

### Requirement: Property model modified
The `Property` model (`app/Models/Property.php`) MUST be modified to include `bedroom` and `bathroom` attributes.
#### Scenario: Fillable attributes
The `Property` model MUST have `bedroom` and `bathroom` in its `$fillable` array (or equivalent using `$guarded`).
#### Scenario: Relationship with Amenity
The `Property` model MUST define a `belongsToMany` relationship with the `Amenity` model.

### Requirement: Property and Amenity relationships defined
The `Property` model MUST define a `belongsToMany` relationship to the `Amenity` model, and the `Amenity` model MUST define a `belongsToMany` relationship to the `Property` model.
#### Scenario: Property has many Amenities
The `Property` model MUST have an `amenities()` method returning `belongsToMany(Amenity::class)`.
#### Scenario: Amenity belongs to many Properties
The `Amenity` model MUST have a `properties()` method returning `belongsToMany(Property::class)`.
