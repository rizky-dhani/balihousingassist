# Capability: Site Analytics

## ADDED Requirements

### Requirement: Analytics Integration
The system SHALL be integrated with Google Analytics 4 via the `spatie/laravel-analytics` package.

#### Scenario: Verify Installation
- **Given** I am a developer
- **When** I run `composer require spatie/laravel-analytics`
- **Then** the package is installed and its configuration file is published.

### Requirement: Analytics Dashboard Page
A dedicated Filament page SHALL exist to display site analytics.

#### Scenario: Access Analytics Page
- **Given** I am logged into the admin dashboard as an authorized user
- **When** I navigate to the "Analytics" page
- **Then** I should see a dashboard containing widgets for page views and active users.

### Requirement: Analytics Widgets
The analytics page SHALL feature modular widgets for different metrics.

#### Scenario: View Page Views Widget
- **Given** I am on the Analytics page
- **When** the page loads
- **Then** I should see a chart or statistic showing page views over the last 7 days.
