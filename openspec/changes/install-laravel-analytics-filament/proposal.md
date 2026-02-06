# Proposal: Install Laravel Analytics and Setup Filament Page

## Problem
Currently, the BHA application lacks a way to track and view site analytics (e.g., page views, popular properties) directly within the admin dashboard. 

## Solution
Integrate `spatie/laravel-analytics` to fetch data from Google Analytics and create a dedicated Filament page to display key metrics to the admin.

## Scope
- Install and configure `spatie/laravel-analytics`.
- Create a new Filament page `AnalyticsDashboard`.
- Implement widgets for key metrics (Page Views, Active Users, etc.).
- Ensure proper authorization for the analytics page.
