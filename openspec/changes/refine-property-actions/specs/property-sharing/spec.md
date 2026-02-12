# Spec Delta: Property Sharing

## MODIFIED Requirements

### [Requirement: Property Hero Actions]
The property hero section must provide relevant actions for the user, focusing on sharing and contact.

#### Scenario: Remove Wishlist Button
- **Given** I am viewing a property detail page
- **Then** I should not see a wishlist or "heart" button in the hero header area

#### Scenario: Enhanced Share Button
- **Given** I am viewing a property detail page
- **When** I look at the hero header area
- **Then** I should see a button labeled "Share" next to a share icon
- **And** the button should have a visible border (`border-base-300`)
- **And** the button should be styled as a pill or rounded rectangle (not a circle)

#### Scenario: Share Functionality
- **Given** I am viewing a property detail page
- **When** I click the "Share" button
- **Then** the browser should attempt to open the native share sheet (if supported)
- **And** if not supported, the current URL should be copied to my clipboard
- **And** I should receive immediate visual feedback that the action occurred (e.g., button text changes to "Copied!")
