# Design: Property Image Gallery

## Architecture
The system will use a simple, file-system-based storage approach for property images.

### Data Storage
- **Database:** A new `images` column of type `json` (or `longText` with JSON casting) will be added to the `properties` table.
- **File System:** Images will be stored in the default `public` disk under a `properties` directory.

### UI Implementation
- **Filament:** Use `Filament\Forms\Components\FileUpload`.
    - `multiple()`: Enable multiple file selection.
    - `reorderable()`: Allow admins to drag and drop images to set the display order.
    - `image()`: Restrict uploads to image files.
    - `directory('properties')`: Organize files on the disk.

## Alternatives Considered
- **Spatie Media Library:** User explicitly requested not to use it.
- **Separate `property_images` table:** Overkill for simple ordering of a reasonable number of images. A JSON column is sufficient for Filament's `FileUpload` component which handles path arrays natively.
