## MODIFIED Requirements

### Requirement: Property model modified
The `Property` model (`app/Models/Property.php`) MUST be modified to include `bedroom` and `bathroom` attributes.
#### Scenario: Fillable attributes
The `Property` model MUST have `bedroom` and `bathroom` in its `$fillable` array (or equivalent using `$guarded`).
#### Scenario: Casts for new attributes
The `Property` model MUST cast `bedroom` to `integer` and `bathroom` to `float` or `decimal`.
#### Scenario: Relationship with Amenity
The `Property` model MUST define a `belongsToMany` relationship with the `Amenity` model via an `amenities()` method.
