# property-management Specification

## Purpose
TBD - created by archiving change init-property-catalog. Update Purpose after archive.
## Requirements
### Requirement: Property CRUD
The system SHALL allow administrators to create, read, update, and delete property records through the Filament dashboard.

#### Scenario: Admin creates a new villa
- **WHEN** the admin fills in the property name, type (Villa), location, and prices
- **THEN** a new property record is saved in the database
- **AND** it appears in the properties list

### Requirement: Property Categorization
The system SHALL support different property types including Villa, Guest House, and Loft.

#### Scenario: Categorize as Loft
- **WHEN** a property is created or edited
- **THEN** the admin can select "Loft" as the property type

### Requirement: Stay Duration Pricing
The system SHALL allow setting prices for both short-term (daily/weekly) and long-term (monthly/yearly) stays.

#### Scenario: Set daily and monthly rates
- **WHEN** editing a property
- **THEN** the admin can input a daily rate and a monthly rate independently

