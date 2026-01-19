# Project Context

## Purpose
Bali Housing Assist (BHA) is an independent real estate company based in Bali. This application serves as their Property Catalog, showcasing rentals including Villas, Guest Houses, and Lofts for both short-term (daily/weekly) and long-term (monthly/yearly) stays.

## Tech Stack
- **Backend:** PHP 8.4, Laravel 12
- **UI Framework:** Filament 5 (Server-Driven UI), Livewire 4
- **Styling:** Tailwind CSS 4, daisyUI (UI components), HyperUI (Component library)
- **Database:** MariaDB
- **Authorization:** Spatie Laravel Permission
- **Build Tool:** Vite 6
- **Local Development:** Laravel Sail

## Project Conventions

### Code Style
- **Formatter:** Laravel Pint (using the default Laravel preset).
- **PHP Features:** Strict typing, constructor property promotion, and arrow functions where appropriate.
- **Naming:** CamelCase for methods and variables, StudlyCase for classes and Enums.

### Architecture Patterns
- **Standard Laravel 12:** Following the streamlined directory structure.
- **Filament Resources:** Business logic for the admin panel is encapsulated within Filament Resource classes.
- **Middleware/Exceptions:** Configured in `bootstrap/app.php`.

### Testing Strategy
- **Framework:** Pest 4.
- **Approach:** Feature tests for all Filament resources and actions. Unit tests for complex business logic and service classes.
- **Database:** Use of factories and seeders for test data setup.

### Git Workflow
- **Branching Strategy:** 
    - Always push changes to the `dev` branch first.
    - Merge to `master` only upon explicit instruction.
- **Commit Conventions:** Follow best practices for git commits (e.g., conventional commits, clear and descriptive subjects, body for context if necessary).

## Domain Context
The application manages a catalog of rental properties in Bali. Key entities include Properties (Villas, Guest Houses, Lofts), Availability (short-term vs long-term), and Pricing structures corresponding to stay duration. It utilizes Filament's SDUI to manage these records efficiently.

## Important Constraints
- Minimum PHP version: 8.4.
- Strictly adheres to Laravel 12 architecture.

## External Dependencies
- Spatie Laravel Permission for RBAC.
- Filament/Livewire for the dashboard.
- daisyUI and HyperUI for the public frontend.
