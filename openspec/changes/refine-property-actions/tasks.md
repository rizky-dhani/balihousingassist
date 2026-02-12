# Tasks: Refine Property Actions

## Implementation

- [x] **Remove Wishlist Button:**
    - Delete the button element containing the heart icon SVG in `resources/views/livewire/properties/show-property.blade.php`.
- [x] **Update Share Button UI:**
    - Change button classes from `btn-circle` to `btn-outline rounded-full px-4`.
    - Ensure it has `border-base-300`.
    - Add "Share" text inside the button next to the icon.
    - Use a consistent Hugeicons component if possible (`x-hugeicons-share-01` or similar).
- [x] **Implement Share Logic:**
    - Add an Alpine.js `@click` handler to the Share button.
    - Implement logic to use `navigator.share()` or fallback to `navigator.clipboard.writeText()`.
    - Add a `copied` state to provide visual feedback.

## Verification

- [x] **Manual Verification:**
    - Visit a property page.
    - Verify the Wishlist button is gone.
    - Verify the Share button is present with text and border.
    - Click the Share button and verify clipboard/share behavior.
- [x] **Test Creation:**
    - Create a new Pest test `tests/Feature/PropertyShareTest.php` to verify the UI changes (presence of Share text, absence of wishlist icon).