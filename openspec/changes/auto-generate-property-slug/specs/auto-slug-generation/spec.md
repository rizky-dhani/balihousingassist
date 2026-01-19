## ADDED Requirements

### Requirement: Automatically generate property slug
This requirement MUST ensure that the `slug` field of a `Property` model is automatically generated from its `name` field.

#### Scenario: Creating a property with a name
Given a user is creating a new property,
And they provide a value for the `name` field,
When the property is saved,
Then the `slug` field MUST be automatically populated with a URL-friendly version of the `name`.

#### Scenario: Updating a property's name
Given a user is updating an existing property,
And they modify the `name` field,
When the property is saved,
Then the `slug` field MUST be automatically regenerated based on the new `name`.

#### Scenario: Updating a property without changing its name
Given a user is updating an existing property,
And they modify fields other than the `name`,
When the property is saved,
Then the `slug` field MUST remain unchanged.

## MODIFIED Requirements

### Requirement: Remove manual slug input from Filament form
This requirement MUST MODIFY the Filament property creation/edit form to remove the manual input field for the `slug`.

#### Scenario: Accessing Property form in Filament
Given an administrator accesses the property creation or editing form in the Filament admin panel,
When the form is displayed,
Then there MUST NOT be a visible input field for the `slug`.
