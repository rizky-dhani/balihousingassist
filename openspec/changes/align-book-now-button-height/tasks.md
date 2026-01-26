# Tasks: Align "Book Now" Button Height

This document outlines the tasks required to align the "Book Now" button height on property listing cards.

## Implementation Tasks

1.  **Identify target elements:**
    *   Locate the Blade file responsible for rendering individual property cards (`resources/views/livewire/properties/list-properties.blade.php` or a partial it includes).
    *   Identify the HTML structure of a single property card, particularly the container holding the property name, description, and the "Book Now" button.
2.  **Analyze existing styling:**
    *   Examine the current Tailwind CSS classes applied to these elements to understand existing layout and spacing.
3.  **Apply CSS solution:**
    *   Implement a CSS solution (e.g., using Flexbox on the parent container) to ensure the "Book Now" button is consistently aligned at the bottom of each property card, regardless of the text content above it. This may involve adding or modifying Tailwind CSS classes.
4.  **Verify visual consistency:**
    *   Manually inspect the property listing page in a web browser to ensure all "Book Now" buttons are of equal height and correctly aligned.
    *   Test with properties having short and long names to confirm the fix works in various scenarios.

## Testing Tasks

1.  **Feature Test:** Create a new feature test or modify an existing one to assert that the "Book Now" button is rendered correctly with consistent positioning/height within the property card structure. This might involve asserting specific CSS classes or structural elements.

## Verification

1.  Run `vendor/bin/pint` to ensure code style compliance.
2.  Run `php artisan test --compact` to ensure all tests pass.
3.  Manually review the property listing page in the browser to confirm the visual fix.