## ADDED Requirements

### Requirement: Navigation migration created and applied
A new database migration MUST be created for a `navigation` table.
#### Scenario: Table columns
The `navigation` table MUST include the following columns:
- `id` (primary key)
- `parent_id` (foreign key to `id` on the same table, nullable)
- `label` (string)
- `url` (string)
- `order` (integer, default 0)
- `new_tab` (boolean, default false)
- `created_at` (timestamp)
- `updated_at` (timestamp)
