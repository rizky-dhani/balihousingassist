## Context

Currently, all properties are treated equally in the system. The site administrator needs a way to highlight specific properties and ensure they appear at the top of the search results and home page listings.

## Goals / Non-Goals

**Goals:**
- Add a mechanism to mark properties as "Featured".
- Prioritize featured properties in all property listings.
- Visually distinguish featured properties in the UI with a badge.
- Allow administrators to easily manage the featured status from the dashboard.

**Non-Goals:**
- Creating a separate "Featured Properties" page (they will be integrated into existing lists).
- Implementing a limited number of featured slots (any number can be featured).

## Decisions

- **Database**: Add an `is_featured` boolean column to the `properties` table.
- **Model**: Update `App\Models\Property` to include `is_featured` in `$fillable` and `casts`.
- **Admin UI**: 
    - Update `PropertyForm` to include a `Toggle` for `is_featured`.
    - Update `PropertiesTable` to include an `IconColumn` for `is_featured`.
- **Frontend Logic**:
    - Modify `ListProperties.php` to include `orderBy('is_featured', 'desc')` as the primary sort criteria in the `render` method.
- **Frontend UI**:
    - Update `single-property.blade.php` to show a "Featured" badge. The badge will be a `badge-secondary` (or distinct color) and placed next to/above the category badge.

## Risks / Trade-offs

- **Risk**: Sorting by multiple columns might affect performance.
- **Mitigation**: The property list is currently small. If it grows significantly, an index on `(is_featured, created_at)` can be added.
- **Trade-off**: Featured properties will always be at the top, which might hide newer non-featured properties from the immediate view. This is intended behavior.
