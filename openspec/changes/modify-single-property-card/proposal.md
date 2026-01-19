# Modify Single Property Card Display

This proposal outlines the changes to the `single-property.blade.php` component to adjust the display of property details.

## Problem

The current property card displays daily and monthly pricing, but lacks the display of location. The daily price format needs to be updated and positioned below the bedroom information.

## Proposed Solution

-   **Remove Redundant Pricing**: Eliminate the display of monthly pricing from the property card.
-   **Update Daily Pricing Format**: Change the daily pricing display to "Price / night" and reposition it below the bedroom count.
-   **Add Location Display**: Introduce the property's location information prominently on the card.
-   **Add Bedroom and Bathroom Display**: Add the bedroom and bathroom counts to the card.

## Dependencies

-   None specific to other proposals, but relies on `Property` model having `bedroom`, `bathroom` and `location` attributes available.

## Next Steps

Upon approval, the following tasks will be executed to implement the proposed changes.
