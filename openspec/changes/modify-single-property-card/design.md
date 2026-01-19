# Design for Modifying Single Property Card Display

## 1. Information Placement and Formatting

### Architectural Reasoning

The current `single-property.blade.php` component requires re-organization of displayed property details to improve clarity and highlight key information. The removal of monthly pricing simplifies the card, while the repositioning and reformatting of daily pricing, along with the addition of location, bedroom, and bathroom details, provides essential information more prominently.

### Details

-   **Pricing Section Restructuring**:
    -   The `div` containing `price_monthly` will be removed entirely.
    -   The `price_daily` display will be retained and its format changed to "IDR {{ number_format($property->price_daily) }} / night".
-   **Bedroom and Bathroom Display**:
    -   New elements will be introduced to display `$property->bedroom` and `$property->bathroom`. These will be placed prominently, likely near the property name or description, and styled to fit the existing aesthetic.
-   **Location Display**:
    -   A new element will display `$property->location` (initially using the simple `location` string, and later updated to use the `PropertyLocation` relationship once that is implemented). This should be placed in a visible area, possibly near the property name or the bed/bath counts.
-   **Daily Price Repositioning**:
    -   The formatted daily price ("Price / night") will be moved to be directly below the section displaying the bedroom and bathroom counts.
