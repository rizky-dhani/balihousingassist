# Add Property Amenities and Bedroom/Bathroom Fields

## Overview
This proposal outlines the creation of an `Amenity` resource and its integration into the existing `Property` management system. It also includes adding dedicated fields for `bedroom` and `bathroom` counts directly to the `Property` model. The `Amenity` resource will be nested under `Properties` in the Filament admin panel, and properties will be able to select multiple amenities via a checkbox list.

## Motivation
To provide a comprehensive and structured way to define and manage property characteristics. Adding `bedroom` and `bathroom` fields directly to properties simplifies common property attributes. The `Amenity` resource allows for a flexible and reusable list of features (e.g., "Swimming Pool," "Gym," "Balcony") that can be associated with any property, improving data accuracy and search capabilities. Nesting the `Amenity` resource under `Properties` implies a relationship management, likely a many-to-many.

## Scope
This proposal covers:
- Creation of an `Amenity` Eloquent model.
- Creation of a database migration for an `amenities` table.
- Modification of the existing `Property` model to include `bedroom` and `bathroom` fields and to establish a many-to-many relationship with `Amenity`.
- Modification of the existing `properties` database migration to add `bedroom` (integer) and `bathroom` (decimal/float) fields.
- Creation of an `Amenity` Filament resource.
- Modification of the existing `Property` Filament resource to include inputs for `bedroom` and `bathroom`, and a `CheckboxList` field for selecting `Amenity` items.
- Configuration to nest the `Amenity` Filament resource under the `Property` Filament resource.

## High-Level Plan
1. Create `Amenity` model and its migration.
2. Modify `Property` model to add `bedroom`, `bathroom` and `belongsToMany` relationship to `Amenity`.
3. Modify `properties` table migration to include `bedroom` and `bathroom` columns.
4. Create `Amenity` Filament resource.
5. Modify `Property` Filament resource to include `bedroom`, `bathroom` fields and `CheckboxList` for amenities.
6. Configure Filament navigation for nesting `Amenity` under `Property`.
7. Create a pivot table for `property_amenity` for the many-to-many relationship.

## Assumptions
- An existing `Property` Eloquent model and `properties` database table.
- An existing `Property` Filament resource (`PropertyResource`).
- Filament is installed and configured in the application.
