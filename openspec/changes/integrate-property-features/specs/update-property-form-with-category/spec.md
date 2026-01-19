## MODIFIED Requirements

### Requirement: PropertyForm Category Selection
The `App\Filament\Resources\Properties\Schemas\PropertyForm` MUST be updated to include a field for selecting a `PropertyCategory`.

#### Scenario: Category Select Field
The `PropertyForm` MUST include a `Select` component for the `property_category_id` field. This select component MUST:
- Be labeled "Category".
- Be required.
- Load options from the `PropertyCategory` model, displaying the `name` of each category.
- Be searchable.
- Be placed logically within the form (e.g., near the `name` or `type` fields).
