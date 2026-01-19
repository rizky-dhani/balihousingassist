## ADDED Requirements

### Requirement: Filament Navigation resource created
A new Filament resource named `NavigationResource` MUST be created in `app/Filament/Resources`.
#### Scenario: Resource linked to model
The `NavigationResource` MUST be linked to the `App\Models\Navigation` model.

### Requirement: Navigation resource form fields defined
The `form` method within `NavigationResource` MUST define the following fields:
#### Scenario: Label field
A `TextInput` field for `label` that is required.
#### Scenario: URL field
A `TextInput` field for `url` that is required.
#### Scenario: Parent ID field
A `Select` field for `parent_id` that is nullable and populated with `Navigation` items (excluding the current item when editing).
#### Scenario: Order field
A `TextInput` field for `order` that is numeric and defaults to 0.
#### Scenario: New tab field
A `Toggle` field for `new_tab` that defaults to false.

### Requirement: Navigation resource table columns defined
The `table` method within `NavigationResource` MUST define the following columns:
#### Scenario: Label column
A `TextColumn` for `label` that is searchable and sortable.
#### Scenario: URL column
A `TextColumn` for `url` that is searchable.
#### Scenario: Parent column
A `TextColumn` for displaying the `label` of the parent navigation item, if any.
#### Scenario: Order column
A `TextColumn` for `order` that is sortable.
#### Scenario: New tab column
A `IconColumn` or `BooleanColumn` for `new_tab` that visually indicates its status.
