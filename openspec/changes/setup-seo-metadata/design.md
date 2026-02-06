# Design: SEO Metadata Setup (RalphJSmit)

## Architecture Reasoning
Switching to `ralphjsmit/laravel-seo` provides an automation-first approach with high scalability for future resources like Blogs.

### Data Model
- **Polymorphic Storage:** SEO data is stored in a central `seo` table. Each model (e.g., `Property`) relates to this table via a polymorphic `HasOne` relationship.
- **Benefits:** No need to add SEO columns to every single table in the future. The `HasSEO` trait handles the relationship and data retrieval.

### Integration
- **Model:** The `Property` model will use the `RalphJSmit\LaravelSeo\Support\HasSEO` trait.
- **Filament:** We will use `RalphJSmit\LaravelFilamentSeo\SEO` to add a standardized SEO section to the `PropertyResource`.
- **Frontend:** The `resources/views/layouts/app.blade.php` will be updated to include the `<x-seo />` component.

### Performance Optimization
To avoid N+1 queries on the property listing or detail pages, we will ensure that the `seo` relationship is eager loaded where necessary, though for a single property detail page, the impact is negligible.

### Fallbacks
We will configure the package to automatically use:
- `Property->name` as the default SEO Title.
- `Property->description` (truncated) as the default SEO Description.
