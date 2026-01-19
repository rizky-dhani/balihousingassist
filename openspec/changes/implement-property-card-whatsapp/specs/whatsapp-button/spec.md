## ADDED Requirements

### Requirement: single-property.blade.php used as loop card
The "Our Properties" section MUST render individual property listings using the `resources/views/components/single-property.blade.php` Blade component in a loop.
#### Scenario: Component rendering
When the "Our Properties" section is viewed, each property MUST be displayed using an instance of the `single-property.blade.php` component.

### Requirement: WhatsApp "Book Now" button present on property card
The `single-property.blade.php` component MUST include a button labeled "Book Now" that initiates a WhatsApp conversation.
#### Scenario: Button label
The button MUST display the text "Book Now".
#### Scenario: WhatsApp link functionality
Clicking the "Book Now" button MUST open a WhatsApp conversation with a predefined number and a pre-filled message including the property's name.
#### Scenario: Configurable WhatsApp number
The WhatsApp number used in the link MUST be configurable, ideally through environment variables or a configuration file.
