# Design: Refine Property Actions

## Architectural Overview
The changes will be implemented directly within the `show-property.blade.php` Livewire component's view. We will leverage Alpine.js for the client-side interaction (sharing/copying).

## Component Structure
The hero header action area will be simplified from two icon-only circular buttons to a single, descriptive action button.

### Share Functionality
We will implement a `shareProperty()` method within the `x-data` object of the section or a localized `x-data` on the button itself.

**Logic Flow:**
1.  Check if `navigator.share` is available.
2.  If yes, call `navigator.share()` with the property name and current URL.
3.  If no (fallback), copy the current URL to the clipboard using `navigator.clipboard.writeText()` and provide a brief visual feedback (e.g., changing text to "Copied!").

## Visual Design
- **Removal:** The button containing the `M4.318 6.318...` SVG (wishlist) will be removed.
- **Modification:** The button containing the `M8.684 13.342...` SVG (share) will be updated:
    - Change `btn-circle` to a standard button class (or `btn-outline` with adjusted padding).
    - Add a `border-base-300` or similar "touch of border".
    - Insert a `<span>Share</span>` next to the SVG.
    - Ensure alignment using Flexbox (`flex items-center gap-2`).

## Dependencies
- **Alpine.js:** Already used in the project for `x-data` and `waUrl` logic.
- **Hugeicons:** We should check if there's a more consistent Share icon in the Hugeicons set already used in the project (e.g., `x-hugeicons-share-01`).
