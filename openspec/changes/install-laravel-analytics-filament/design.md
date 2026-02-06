# Design: Site Analytics Integration

## Architecture
The integration will follow a standard Service-Widget-Page pattern:
- **Service Layer:** `spatie/laravel-analytics` will be used as the underlying service to communicate with Google Analytics 4 (GA4).
- **Widgets:** Custom Filament widgets will be created to fetch data from the service and render charts or stat cards.
- **Page:** A custom Filament page (`App\Filament\Pages\Analytics`) will host these widgets.

## Data Flow
1. User visits the Analytics page in Filament.
2. The page loads the registered Analytics widgets.
3. Each widget calls `Analytics::fetch...()` methods from the Spatie package.
4. Data is processed into the format required by Filament/Chart.js.
5. Metrics are rendered in the UI.

## Authorization
- Access to the Analytics page will be restricted via a policy or a `canAccess` method on the Page class, likely tied to a `view_analytics` permission.

## Configuration
- `ANALYTICS_PROPERTY_ID` and a service account JSON file will be required in `.env`.
- For development/testing, the package should be configured to handle missing credentials gracefully (e.g., returning empty data or a warning).
