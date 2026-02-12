## MODIFIED Requirements

### Requirement: Basic Filtering
The system SHALL allow users to filter properties by type (Villa, Guest House, Loft), location, bedrooms, bathrooms, and price range reactively without a full page reload.

#### Scenario: Filter by Villa
- **WHEN** the user selects "Villa" from the type filter
- **THEN** only properties categorized as "Villa" are displayed in the grid immediately

#### Scenario: Filter by Price Range
- **WHEN** the user opens Advanced Filters and sets a minimum and maximum price
- **AND** clicks "Apply Filters"
- **THEN** only properties with a daily price within that range are displayed
