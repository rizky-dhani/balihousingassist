## ADDED Requirements

### Requirement: Dynamic property image gallery
This requirement MUST ensure that the `show-property.blade.php` displays a dynamic image gallery using the `images` array from the `Property` model.

#### Scenario: Property with multiple images
Given a user navigates to a property's detail page,
And the `$property` model has an `images` array with multiple image paths,
When the page loads,
Then the first image from the `images` array MUST be displayed as the main property image,
And a gallery of thumbnail images from the `images` array MUST be displayed below the main image.

#### Scenario: Property with a single image
Given a user navigates to a property's detail page,
And the `$property` model has an `images` array with a single image path,
When the page loads,
Then that single image MUST be displayed as the main property image,
And a single thumbnail image corresponding to the main image MUST be displayed below the main image.

#### Scenario: Property with no images
Given a user navigates to a property's detail page,
And the `$property` model has an empty `images` array,
When the page loads,
Then a fallback placeholder image SHOULD be displayed in place of the main property image,
And the thumbnail gallery section SHOULD NOT be displayed.
