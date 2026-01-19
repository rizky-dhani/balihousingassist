## MODIFIED Requirements

### Requirement: Properties table migration modified and applied
The `properties` table migration MUST be modified to add `bedroom` and `bathroom` columns.
#### Scenario: Bedroom column
The `properties` table MUST include a `bedroom` column (integer, nullable, default 0).
#### Scenario: Bathroom column
The `properties` table MUST include a `bathroom` column (decimal with precision and scale, nullable, default 0.0).
