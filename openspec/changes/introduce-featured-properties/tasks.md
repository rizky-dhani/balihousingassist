## 1. Database & Model

- [x] 1.1 Create migration to add `is_featured` boolean column to `properties` table
- [x] 1.2 Run database migrations
- [x] 1.3 Update `Property` model to include `is_featured` in `$fillable` and `casts()`

## 2. Admin Dashboard (Filament)

- [x] 2.1 Add `is_featured` toggle to `PropertyForm` (Pricing & Images step)
- [x] 2.2 Add `is_featured` icon column to `PropertiesTable`

## 3. Frontend Implementation

- [x] 3.1 Update `ListProperties` Livewire component to order by `is_featured` descending before other sort criteria
- [x] 3.2 Update `single-property` component to display a "Featured" badge above the property image

## 4. Verification & Testing

- [x] 4.1 Verify properties can be toggled as featured in the Filament dashboard
- [x] 4.2 Verify featured properties appear first in the public listing
- [x] 4.3 Verify the "Featured" badge is correctly displayed and positioned on the property card
