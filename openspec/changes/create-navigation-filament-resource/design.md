# Create Navigation Filament Resource - Design

## Data Model
The `Navigation` model will represent a single navigation item. Key fields include:
- `id`: Primary key.
- `parent_id`: Foreign key to `id` on the same table, allowing for hierarchical navigation. Nullable for top-level items.
- `label`: String, the display text for the navigation item.
- `url`: String, the URL the navigation item links to.
- `order`: Integer, to control the display order of navigation items within the same parent/level.
- `new_tab`: Boolean, indicating if the link should open in a new browser tab.

## Filament Resource Structure
The `NavigationResource` will provide a standard Filament interface for managing these navigation items.

### Form
The form will include:
- A text input for `label`.
- A text input for `url`.
- A select field for `parent_id`, populated with existing `Navigation` items. This will allow for easy creation of nested navigation.
- A number input for `order`.
- A toggle switch for `new_tab`.

### Table
The table will display:
- `label`
- `url`
- `parent` (displaying the label of the parent navigation item, if any)
- `order`
- `new_tab` (displayed as an icon or boolean indicator)

Sorting will be available for `order` and `label`. Searching will be available for `label` and `url`.

## Relationships
The `Navigation` model will define `parent()` and `children()` Eloquent relationships to facilitate tree-like structures.

## User Experience
Administrators will be able to:
- Create new navigation items, assigning them a label, URL, parent (optional), order, and new tab preference.
- Edit existing navigation items.
- Delete navigation items.
- View a paginated and sortable list of navigation items, with parent-child relationships clearly indicated.