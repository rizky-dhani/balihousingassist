# Use single-property.blade.php for Our Properties section's loop card with WhatsApp button labelled "Book Now" - Design

## Component Integration
The `single-property.blade.php` component is assumed to be a Blade component located at `resources/views/components/single-property.blade.php`. This component will be rendered using the Blade component syntax (`<x-single-property :property="$property" />`) within a loop in the main "Our Properties" section's view.

### Expected `single-property.blade.php` Data Structure
The `single-property.blade.php` component is expected to receive a `property` object (or array) containing at least the following attributes:
- `id`: Unique identifier for the property.
- `name` or `title`: The name of the property to be displayed.
- Any other attributes necessary for the existing display of the property card.

## WhatsApp Button Implementation
A button with the text "Book Now" will be added to the `single-property.blade.php` component. This button will be styled appropriately to visually stand out.

### WhatsApp Link Generation
The "Book Now" button will be an `<a>` tag with an `href` attribute dynamically generated to open a WhatsApp chat. The structure of the URL will be:
`https://wa.me/<whatsapp_number>?text=I'm%20interested%20in%20property%20[PROPERTY_NAME]`

- `<whatsapp_number>`: This will be a configurable WhatsApp number (e.g., from environment variables or a configuration file).
- `[PROPERTY_NAME]`: This will be dynamically populated from the `property` object passed to the `single-property.blade.php` component. It will be URL-encoded.

## User Flow
1. User navigates to the "Our Properties" section.
2. They see a list of property cards, each rendered using `single-property.blade.php`.
3. Each card has a "Book Now" button.
4. User clicks "Book Now" on a specific property.
5. A new WhatsApp chat window opens (or the WhatsApp app on mobile), pre-filled with a message indicating interest in that specific property.