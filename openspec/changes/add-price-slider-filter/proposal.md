# Proposal: Add Price Slider Filter

## Problem
Users currently cannot filter properties by price range on the List Properties page. They can only sort by price, but cannot set specific bounds (minimum and maximum).

## Proposed Solution
Add a price range filter to the "Advanced Filters" modal on the List Properties page. This will include two range sliders or inputs to define the minimum and maximum daily price.

## Impact
- **Livewire Component:** `ListProperties` will have new public properties for `min_price` and `max_price`.
- **Filtering Logic:** The `render` method will be updated to filter the query based on these bounds.
- **UI:** The Advanced Filters modal will gain a new section for Price Range.
- **URL:** The `min_price` and `max_price` will be synchronized with the URL.
