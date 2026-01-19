## ADDED Requirements

### Requirement: Centralized Navigation Configuration
The application MUST include a configuration file, `config/navigation.php`, to centralize the definition of global navigation links.

#### Scenario: Configuration File Existence
The application MUST include a configuration file, `config/navigation.php`, to centralize the definition of global navigation links.

### Requirement: Navigation Item Structure
Each navigation item in `config/navigation.php` MUST be an associative array containing at least a `label` (string) and either a `route` (string, for named routes) or a `url` (string, for direct URLs).

#### Scenario: Navigation Item Structure
Each navigation item in `config/navigation.php` MUST be an associative array containing at least a `label` (string) and either a `route` (string, for named routes) or a `url` (string, for direct URLs).

### Requirement: Header and Footer Consumption
Both the `<x-header />` and `<x-footer />` Blade components MUST retrieve their navigation links from the `config('navigation')` helper.

#### Scenario: Header and Footer Consumption
Both the `<x-header />` and `<x-footer />` Blade components MUST retrieve their navigation links from the `config('navigation')` helper.
