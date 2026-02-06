# Capability: SEO Integration

## ADDED Requirements

### Requirement: Centralized SEO Storage
The system SHALL store SEO metadata in a dedicated polymorphic table to ensure a clean database schema for business models.

#### Scenario: Verify SEO Table
- **Given** I am a developer
- **When** I run the SEO migrations
- **Then** a `seo` table SHOULD exist in the database with `seoable_id` and `seoable_type` columns.

### Requirement: Automated SEO Fallbacks
The system SHALL automatically generate SEO metadata from model attributes if specific SEO overrides are not provided.

#### Scenario: Fallback to Property Name
- **Given** a property named "Sunset Villa" has no custom SEO title
- **When** a visitor views the property page
- **Then** the page title SHOULD automatically be "Sunset Villa".

### Requirement: Integrated Admin UI
The system SHALL provide a standardized SEO management interface within the Filament admin dashboard.

#### Scenario: Admin manages SEO
- **Given** I am editing a property in the Filament dashboard
- **When** I scroll to the SEO section
- **Then** I SHOULD see fields for custom title, description, and social media tags.
