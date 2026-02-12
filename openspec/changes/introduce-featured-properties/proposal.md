## Why

To allow highlighting specific properties as "Featured" to attract more attention and prioritizing them in listings. This helps property owners and the site administrator showcase premium or urgent listings effectively.

## What Changes

- Add a new `is_featured` boolean column to the `properties` table.
- Update the `Property` model to include `is_featured` in fillable and casts.
- Add an "Is Featured" toggle to the Filament `PropertyResource` form.
- Update the `single-property` component to display a "Featured" badge when applicable.
- Modify property listing queries in `ListProperties` to prioritize featured properties in the default sort order.

## Capabilities

### New Capabilities
- `featured-properties`: Management and display of featured properties, including a new database field and UI badges.

### Modified Capabilities
- `property-listing`: Update listing logic to sort by `is_featured` by default, ensuring featured properties appear first.

## Impact

- **Database**: `properties` table will have a new column.
- **Backend**: `Property` model and `PropertyResource` will be updated.
- **Frontend**: `single-property` component and `ListProperties` component will be updated.
