# Capability: Property Listing

## ADDED Requirements

### Requirement: Public Property Grid
The system SHALL display all available properties in a responsive grid layout on the homepage/catalog page.

#### Scenario: View all properties
- **WHEN** a visitor accesses the website
- **THEN** they see a list of available properties with their names, types, and starting prices

### Requirement: Property Detail View
The system SHALL provide a dedicated page for each property showing full details, including descriptions and all pricing options.

#### Scenario: View villa details
- **WHEN** a user clicks on a property card
- **THEN** they are redirected to a page showing the property's full description and pricing for different stay durations

### Requirement: Basic Filtering
The system SHALL allow users to filter properties by type (Villa, Guest House, Loft).

#### Scenario: Filter by Villa
- **WHEN** the user selects "Villa" from the type filter
- **THEN** only properties categorized as "Villa" are displayed in the grid
