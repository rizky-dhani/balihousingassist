# Create Navigation Filament Resource

## Overview
This proposal outlines the creation of a Filament resource for managing a `Navigation` model. The `Navigation` model will represent individual navigation items and support parent-child relationships for nested menus, as well as a boolean field to indicate if a link should open in a new tab.

## Motivation
The current application likely lacks a centralized and easily manageable system for navigation. By introducing a Filament resource, administrators will be able to effortlessly create, update, and reorder navigation items directly from the Filament admin panel. This will provide flexibility in structuring application menus without requiring code changes.

## Scope
This proposal covers the following aspects:
- Creation of an `Navigation` Eloquent model.
- Creation of a database migration for the `navigation` table, including fields for `parent_id`, `label`, `url`, `order`, and `new_tab`.
- Creation of a Filament resource (`NavigationResource`) that provides CRUD operations for `Navigation` items, supporting parent-child selection in the form and displaying the hierarchical structure in the table.

## High-Level Plan
1. Create the `Navigation` model.
2. Create the `navigation` table migration with necessary fields.
3. Create the `NavigationResource` for Filament, defining its form schema and table columns.

## Dependencies
- Laravel application with Filament installed and configured.
- Database connection for migration.
