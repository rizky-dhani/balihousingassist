## ADDED Requirements

### Requirement: Featured Property Management
The system SHALL allow administrators to mark a property as "Featured" via a toggle in the property management dashboard.

#### Scenario: Mark property as featured
- **WHEN** an administrator toggles the "Is Featured" switch on a property record
- **THEN** the property status is updated in the database
- **AND** the change is reflected immediately on the public listing

### Requirement: Featured Badge Display
The system SHALL display a prominent "Featured" badge on property cards for properties marked as featured.

#### Scenario: View featured badge on card
- **WHEN** a property is marked as "Featured"
- **THEN** a special badge MUST appear on the property card in the listing view
- **AND** it MUST be positioned before the category badge
