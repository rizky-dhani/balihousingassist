## ADDED Requirements

### Requirement: Display Property Amenities
This requirement MUST ensure that the amenities associated with a property are correctly displayed on the property's detail page.

#### Scenario: User views a property with amenities
Given a user navigates to a property's detail page,
And the property has associated amenities,
When the page loads,
Then an "Amenities" section SHOULD be visible before the "Location & Details" section,
And each associated amenity's name SHOULD be listed within this section.

#### Scenario: User views a property without amenities
Given a user navigates to a property's detail page,
And the property has no associated amenities,
When the page loads,
Then the "Amenities" section SHOULD NOT be displayed.