# Change: Migrate Properties to Livewire Components

## Why
To enhance user experience with reactive filtering and pagination without full page reloads. This migration also aligns the public catalog with the project's tech stack preference for Livewire.

## What Changes
- **Component Creation:** Create `Properties\ListProperties` and `Properties\ShowProperty` Livewire components.
- **Route Migration:** Update `routes/web.php` to use full-page Livewire components instead of `PropertyController`.
- **View Refactoring:** Refactor existing Blade views into Livewire component templates.
- **Controller Removal:** Remove `PropertyController` once migration is verified.

## Impact
- Affected specs: `property-listing`
- Affected code: `routes/web.php`, `app/Http/Controllers/PropertyController.php`, `resources/views/properties/`
