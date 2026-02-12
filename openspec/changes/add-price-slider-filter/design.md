# Design: Price Slider Filter

## User Interface
The Advanced Filters modal will include a new section titled "Price Range (Daily)".
It will feature two range sliders:
1. **Minimum Price Slider:** To set the lower bound.
2. **Maximum Price Slider:** To set the upper bound.

Each slider will display its current value formatted as currency (IDR).

## Implementation Details
- **Component:** `App\Livewire\Properties\ListProperties`
- **State:**
    - `$min_price` (integer, default 0)
    - `$max_price` (integer, default 10,000,000 - or dynamically based on max in DB)
- **Formatting:** A helper or Livewire method will be used to format the IDR values for display.
- **Interactivity:** `wire:model.live` will be used for real-time feedback if desired, but since there is an "Apply Filters" button, we might just use `wire:model` and only apply on button click, consistent with other advanced filters.

## Dynamic Range
To make the sliders useful, the maximum value for the sliders should ideally be slightly higher than the actual maximum price in the database.
Current max in DB is ~4.8M. We can set a hard limit of 10M or calculate it dynamically.
For simplicity, we'll start with a reasonable hard limit like 10,000,000 IDR and increments of 100,000 IDR.
