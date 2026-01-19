## MODIFIED Requirements

### Requirement: Property Card Pricing Display
The `single-property.blade.php` component MUST update its pricing display to focus on daily rates and remove redundant monthly pricing.

#### Scenario: Monthly Price Removal
The `single-property.blade.php` component MUST entirely remove the display of the `$property->price_monthly` field.

#### Scenario: Daily Price Format
The `$property->price_daily` field MUST be displayed in the format "IDR {{ number_format($property->price_daily) }} / night".

### Requirement: Property Card Detail Display
The `single-property.blade.php` component MUST include the display of bedroom, bathroom, and location details.

#### Scenario: Bedroom and Bathroom Display
The `single-property.blade.php` component MUST display the `$property->bedroom` and `$property->bathroom` counts.

#### Scenario: Location Display
The `single-property.blade.php` component MUST display the property's location. Initially, this will be `$property->location`, and will be updated to use the `PropertyLocation` relationship upon its implementation.

#### Scenario: Daily Price Position
The formatted daily price ("IDR {{ number_format($property->price_daily) }} / night") MUST be positioned immediately below the displayed bedroom and bathroom counts.
