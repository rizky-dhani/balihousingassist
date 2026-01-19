# Design Document: Auto-generate Property Slug

## 1. Overview
The current system requires manual entry of the 'slug' field for properties, which is prone to errors and inconsistencies. This change aims to automate the generation of the 'slug' from the 'name' field, improving data integrity and user experience.

## 2. Approach
The slug generation will be handled at the Eloquent model level within the `Property` class. This ensures that any creation or update of a `Property` record, regardless of whether it's through the Filament admin panel or other means, will have an automatically generated slug.

### 2.1. Filament Form Modification
The `TextInput` for 'slug' will be removed from `app/Filament/Resources/Properties/Schemas/PropertyForm.php` as it will no longer be a manual input.

### 2.2. Eloquent Model Logic
A `creating` and `updating` Eloquent event will be used within the `App\Models\Property` model. Before a property is saved (either created or updated), the `name` attribute will be used to generate a URL-friendly slug using `Illuminate\Support\Str::slug()`. This slug will then be assigned to the `slug` attribute of the model.

If a `name` is changed, the `slug` will be regenerated. If the `name` is not changed, the existing `slug` will be preserved. This will prevent unintended changes to existing URLs unless the property name itself is modified.

Example:
- Name: "Beautiful Beach House" -> Slug: "beautiful-beach-house"
- Name: "Luxury Villa in Ubud" -> Slug: "luxury-villa-in-ubud"

## 3. Impact
- **User Experience:** Users will no longer need to manually enter or think about the slug.
- **Data Consistency:** Slugs will be consistently generated, reducing errors and improving SEO.
- **Code Maintainability:** Centralizing slug generation logic in the model makes it easier to manage.

## 4. Alternatives Considered
- **Using a Mutator:** A mutator (`setSlugAttribute`) could be used, but Eloquent events provide a clearer separation of concerns for actions that occur before a model is saved.
- **Filament's `dehydrateStateUsing`:** While possible to use `dehydrateStateUsing` on the `name` field in the Filament form to populate the slug, this would only apply to Filament actions and not direct model manipulations. Handling it in the model ensures broader coverage.

## 5. Testing
A feature test will be added to ensure the slug is correctly generated and stored when a property is created or updated.
