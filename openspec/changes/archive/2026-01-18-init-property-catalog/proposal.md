# Change: Initialize Core Property Catalog Features

## Why
Establish the foundational features for Bali Housing Assist (BHA) to allow administrators to manage properties and users to browse them.

## What Changes
- **Property Management (Admin):** CRUD functionality for Villas, Guest Houses, and Lofts via Filament.
- **Property Listing (Public):** A visually appealing frontend to browse and search properties using daisyUI and HyperUI.
- **Data Model:** Initial schema for Properties, including support for short-term and long-term stay configurations.

## Impact
- Affected specs: `property-management`, `property-listing`
- Affected code: `app/Filament/Resources`, `app/Models`, `resources/views`, `database/migrations`
