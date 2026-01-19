# Design Document: Amenities Section on Property Details Page

## 1. Overview
The goal is to enrich the property detail page (`show-property.blade.php`) by introducing a dedicated "Amenities" section. This section will visually list all amenities linked to a specific property, providing a clearer overview of the property's features to the user.

## 2. Placement
The "Amenities" section will be positioned directly before the existing "Location & Details" (map) section in `show-property.blade.php`. This placement ensures that property-specific features are presented before geographical information.

## 3. Data Retrieval
The `ShowProperty` Livewire component already has access to the `$property` model. The amenities will be retrieved via the existing `amenities` relationship on the `Property` model.

## 4. UI/UX Considerations
- The section will have a clear heading, "Amenities".
- Each amenity will be displayed with an icon and its name. A grid or flexbox layout will be used to display amenities efficiently, leveraging existing Tailwind CSS classes for consistency.
- Responsive design will be applied to ensure optimal viewing across various device sizes.

## 5. Styling
Existing Tailwind CSS and DaisyUI classes will be utilized to maintain consistency with the application's current design language.

## 6. Assumptions
- The `Property` model has an `amenities` relationship correctly defined.
- Each `Amenity` model has a `name` attribute for display and potentially an `icon` attribute if icons are to be displayed. (Need to confirm icon availability or default to text).

## 7. Future Considerations
- Dynamic icons for amenities.
- Filtering properties by amenities.