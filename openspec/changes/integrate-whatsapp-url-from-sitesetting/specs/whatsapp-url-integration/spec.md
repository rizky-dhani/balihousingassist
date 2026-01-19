## ADDED Requirements

### Requirement: WhatsApp URL retrieved from SiteSetting
The `resources/views/components/single-property.blade.php` Blade component MUST retrieve the configured WhatsApp number from the `SiteSetting` model.
#### Scenario: Retrieval mechanism
The component MUST access the `whatsapp_number` attribute from the single `SiteSetting` record (e.g., `\App\Models\SiteSetting::get()->whatsapp_number`).

### Requirement: "Book Now" button uses dynamic WhatsApp URL
The "Book Now" button within `resources/views/components/single-property.blade.php` MUST use the WhatsApp number retrieved from `SiteSetting` to construct its `href` attribute.
#### Scenario: Dynamic link construction
The `href` attribute of the "Book Now" button MUST be a WhatsApp deep link (e.g., `https://wa.me/{whatsapp_number}?text={property_message}`) where `{whatsapp_number}` is dynamically populated from `SiteSetting` and `{property_message}` includes the property's name.
#### Scenario: Fallback for missing WhatsApp number
If the `whatsapp_number` in `SiteSetting` is not configured, the "Book Now" button's functionality (e.g., its `href`) MUST gracefully handle this absence (e.g., by being disabled, hidden, or linking to a generic contact page).
