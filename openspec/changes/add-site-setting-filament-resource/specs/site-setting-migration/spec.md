## ADDED Requirements

### Requirement: SiteSetting migration created and applied
A new database migration MUST be created for a `site_settings` table.
#### Scenario: Table columns
The `site_settings` table MUST include the following columns:
- `id` (primary key)
- `facebook_url` (string, nullable)
- `twitter_url` (string, nullable)
- `instagram_url` (string, nullable)
- `linkedin_url` (string, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)
