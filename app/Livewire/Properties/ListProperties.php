<?php

namespace App\Livewire\Properties;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ListProperties extends Component
{
    use WithPagination;

    #[Url]
    public $bedroom = '';

    #[Url]
    public $bathroom = '';

    #[Url]
    public $property_location_id = '';

    #[Url]
    public $category_id = '';

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['bedroom', 'bathroom', 'property_location_id', 'category_id']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Property::query()->where('is_available', true);

        if ($this->bedroom) {
            $query->where('bedroom', $this->bedroom);
        }

        if ($this->bathroom) {
            $query->where('bathroom', '>=', $this->bathroom);
        }

        if ($this->property_location_id) {
            $query->where('property_location_id', $this->property_location_id);
        }

        if ($this->category_id) {
            $query->where('property_category_id', $this->category_id);
        }

        return view('livewire.properties.list-properties', [
            'properties' => $query->latest()->paginate(9),
            'categories' => \App\Models\PropertyCategory::all(),
            'locations' => \App\Models\PropertyLocation::all(),
        ]);
    }
}
