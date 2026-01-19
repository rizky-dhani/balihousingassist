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
    public $type = '';

    #[Url]
    public $bedroom = '';

    #[Url]
    public $bathroom = '';

    #[Url]
    public $location = '';

    #[Url]
    public $category_id = '';

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['type', 'bedroom', 'bathroom', 'location', 'category_id']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Property::query()->where('is_available', true);

        if ($this->type) {
            $query->where('type', $this->type);
        }

        if ($this->bedroom) {
            $query->where('bedroom', $this->bedroom);
        }

        if ($this->bathroom) {
            $query->where('bathroom', '>=', $this->bathroom);
        }

        if ($this->location) {
            $query->where('location', $this->location);
        }

        if ($this->category_id) {
            $query->where('property_category_id', $this->category_id);
        }

        return view('livewire.properties.list-properties', [
            'properties' => $query->latest()->paginate(9),
            'categories' => \App\Models\PropertyCategory::all(),
            'locations' => Property::query()->whereNotNull('location')->distinct()->pluck('location'),
        ]);
    }
}
