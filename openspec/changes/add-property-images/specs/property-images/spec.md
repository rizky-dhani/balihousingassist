# Property Images Specification

## MODIFIED Requirements

### Requirement: Property CRUD
The system SHALL allow administrators to manage property images as part of the property record.

#### Scenario: Admin adds multiple images to a property
- **GIVEN** an admin is creating or editing a property
- **WHEN** the admin uploads several images to the gallery field
- **AND** reorders them using the UI
- **THEN** the image paths are saved in the `images` database column in the specified order
- **AND** the physical files are stored in the storage directory
