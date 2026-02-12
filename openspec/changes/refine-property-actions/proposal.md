# Proposal: Refine Property Actions on Show Property Page

The property detail page currently features two action buttons in the hero area: a Share button and a Wishlist button. This proposal aims to simplify the UI by removing the unimplemented Wishlist button and enhancing the Share button to be functional and more prominent.

## Problem
- The Wishlist button is present but non-functional and adds unnecessary clutter.
- The Share button is an icon-only button without explicit functionality (uses a placeholder SVG).
- Users lack a clear and easy way to share the property URL.

## Proposed Solution
- **Remove Wishlist Button:** Delete the heartbeat/wishlist button from the hero header.
- **Enhance Share Button:**
    - Transform the circle icon button into a pill-shaped button with a border.
    - Add "Share" text to the right of the share icon.
    - Implement functionality to copy the current URL to the clipboard or trigger the native Web Share API using Alpine.js.
    - Update styling to include a subtle border for better definition.

## Impact
- **UI/UX:** A cleaner, more focused header with clear actions.
- **Functionality:** Users can now easily share property details with others.
- **Consistency:** Aligns with the project's minimalist and high-quality aesthetic.
