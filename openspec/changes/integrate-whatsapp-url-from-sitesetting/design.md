# Integrate WhatsApp URL from SiteSetting to "Book Now" button on Property Card - Design

## Context
This design assumes the following prerequisites are met:
- The `add-site-setting-filament-resource` proposal has been implemented. Crucially, the `SiteSetting` model and its corresponding `site_settings` database table now include a `whatsapp_number` field (e.g., `string('whatsapp_number')->nullable()`).
- The `implement-property-card-whatsapp` proposal has been implemented. This means `resources/views/components/single-property.blade.php` exists and contains a "Book Now" button, with its `href` currently hardcoded or using a placeholder.

## WhatsApp URL Retrieval
The WhatsApp number will be retrieved from the `SiteSetting` model using its singleton access method.

```php
// Example retrieval within a Blade view or a view composer
$siteSettings = \App\Models\SiteSetting::get(); // Assuming a get() static method for singleton
$whatsAppNumber = $siteSettings->whatsapp_number;
```

## Modification of `single-property.blade.php`
The existing "Book Now" button in `resources/views/components/single-property.blade.php` will have its `href` attribute updated.

The dynamic WhatsApp link will be constructed using the retrieved `whatsAppNumber` and the property's name (assuming `$property->name` is available within the `single-property.blade.php` component).

```blade
@php
    $siteSettings = \App\Models\SiteSetting::get();
    $whatsAppNumber = $siteSettings->whatsapp_number;
    $propertyMessage = urlencode("I'm interested in property: " . $property->name); // Assuming $property is passed to component
    $whatsAppLink = "https://wa.me/{$whatsAppNumber}?text={$propertyMessage}";
@endphp

<a href="{{ $whatsAppLink }}" target="_blank" class="your-button-styles">
    Book Now
</a>
```

### Fallback/Validation
- If `$whatsAppNumber` is null or empty, the button might be disabled, hidden, or display a fallback message. For a straightforward implementation, it will likely render an empty `href` or a generic message.
- The `whatsapp_number` field in `SiteSetting` should ideally be validated to ensure it's a valid phone number. This validation would be part of the `add-site-setting-filament-resource` implementation.

## User Flow
1.  An administrator configures the WhatsApp number in the `SiteSetting` resource via Filament.
2.  A user browses the "Our Property Catalog" and sees property cards.
3.  Each property card displays a "Book Now" button.
4.  When a user clicks "Book Now" on a property card, a WhatsApp chat opens, pre-filled with a message that includes the property's name and is directed to the centrally configured WhatsApp number.