# Use single-property.blade.php for Our Properties section's loop card with WhatsApp button labelled "Book Now" - Tasks

This document outlines the tasks required to implement the property card with a WhatsApp button.

## Tasks

- [x] **Task 1: Identify "Our Properties" Section View**
    - **Description:** Determine the Blade view file responsible for rendering the "Our Properties" section where `single-property.blade.php` will be used as a loop card. (Assuming `resources/views/welcome.blade.php` for now, but this might be refined).
    - **Verification:** Confirm the path and content of the identified view file.
    - **Depends on:** None

- [x] **Task 2: Examine single-property.blade.php Structure**
    - **Description:** Read the content of `resources/views/components/single-property.blade.php` to understand its current structure and how it expects to receive data.
    - **Verification:** Document the expected props/data structure for the component.
    - **Depends on:** None

- [x] **Task 3: Integrate single-property.blade.php into "Our Properties" Section**
    - **Description:** Modify the "Our Properties" section view (identified in Task 1) to loop through a collection of property data and render `x-single-property` for each item.
    - **Verification:** Render the page and confirm multiple property cards are displayed (without the WhatsApp button yet).
    - **Depends on:** Task 1, Task 2

- [x] **Task 4: Add WhatsApp Button to single-property.blade.php**
    - **Description:** Modify `resources/views/components/single-property.blade.php` to include a button element that links to WhatsApp, labeled "Book Now".
    - **Verification:** Render the page and confirm the "Book Now" button is present on each card.
    - **Depends on:** Task 2

- [x] **Task 5: Implement WhatsApp Link Logic**
    - **Description:** Add logic to the WhatsApp button to generate a dynamic WhatsApp link, potentially including property-specific information in the message (e.g., `https://wa.me/<whatsapp_number>?text=I'm%20interested%20in%20property%20[PROPERTY_NAME]`).
    - **Verification:** Click the "Book Now" button and verify it opens WhatsApp with the correct pre-filled message.
    - **Depends on:** Task 4

- [x] **Task 6: Create/Update Feature Test for WhatsApp Button**
    - **Description:** Create a new feature test or update an existing one to assert the presence and correct functionality of the "Book Now" WhatsApp button on a property card.
    - **Verification:** Run the feature test and ensure it passes.
    - **Depends on:** Task 3, Task 5
