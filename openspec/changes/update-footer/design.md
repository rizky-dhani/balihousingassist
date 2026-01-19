# Design for Footer Update

## 1. Shared Navigation Links

To ensure consistency between the header and footer navigation, a centralized approach for defining navigation links is necessary.

### Approach

- A new configuration file, `config/navigation.php`, will be introduced. This file will define an array of navigation items, each containing a `label` and a `route` or `url`.
- Both the `header.blade.php` component and the new `footer.blade.php` component will consume this configuration to render their respective navigation menus.
- This promotes a single source of truth for navigation, simplifying future updates and reducing redundancy.

### Example `config/navigation.php`

```php
<?php

return [
    [
        'label' => 'About',
        'route' => 'about', // Assuming 'about' is a named route
    ],
    [
        'label' => 'Careers',
        'url' => '/careers', // Or a direct URL
    ],
    // ... other navigation items
];
```

## 2. PropertyCategory Implementation

The "Properties" section of the footer requires displaying property categories.

### Approach

- **Model Creation**: A new Eloquent model, `PropertyCategory`, will be created to represent different categories of properties. This model will have a `name` and a `slug` field.
- **Migration**: A corresponding migration will be generated to create the `property_categories` table in the database.
- **Filament Resource**: A Filament resource, `PropertyCategoryResource`, will be created to manage property categories in the admin panel. This will allow administrators to create, edit, and delete categories.
- **Relationship**: If `Property` models are to be associated with `PropertyCategory`, a relationship (e.g., `hasMany` or `belongsTo`) will be established between them.

## 3. WhatsApp Link

The "Contact Us" link in the "Helpful Links" section needs to utilize the `whatsapp_number` from the `SiteSetting` model.

### Approach

- The `whatsapp_number` from the `SiteSetting` singleton instance will be retrieved.
- A dynamic WhatsApp URL will be constructed using this number (e.g., `https://wa.me/<whatsapp_number>`).
- This URL will be used in the "Contact Us" link in the footer.
