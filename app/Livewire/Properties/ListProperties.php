<?php

namespace App\Livewire\Properties;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Lazy]
class ListProperties extends Component
{
    use WithPagination;

    public function placeholder()
    {
        return view('livewire.properties.list-properties-skeleton');
    }

    #[Url]
    public $search = '';

    #[Url]
    public $bedroom = '';

    #[Url]
    public $bathroom = '';

    #[Url]
    public $property_location_id = '';

    #[Url]
    public $category_id = '';

    #[Url]
    public $sortBy = 'latest';

    public $showBottomFilters = false;

    public $perPage = 9;

    #[Url]
    public $isAdvancedFiltersOpen = false;

    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'bedroom', 'bathroom', 'property_location_id', 'category_id', 'sortBy'])) {
            $this->showBottomFilters = false;
            $this->perPage = 9;
        }
    }

    public function loadMore(): void
    {
        $this->perPage += 9;
    }

    public function applyFilters()
    {
        $this->perPage = 9;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'bedroom', 'bathroom', 'property_location_id', 'category_id', 'sortBy', 'perPage']);
        $this->resetPage();
    }

    public function render()
    {
        sleep(2);
        $query = Property::query()->where('is_available', true);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        }

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

        $query = match ($this->sortBy) {
            'price_low' => $query->orderBy('price_daily', 'asc'),
            'price_high' => $query->orderBy('price_daily', 'desc'),
            'oldest' => $query->oldest(),
            default => $query->latest(),
        };

        return view('livewire.properties.list-properties', [
            'properties' => $query->paginate($this->perPage),
            'categories' => \App\Models\PropertyCategory::all(),
            'locations' => \App\Models\PropertyLocation::all(),
        ]);
    }
}
