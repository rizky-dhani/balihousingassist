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

    public function updatedType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Property::query()->where('is_available', true);

        if ($this->type) {
            $query->where('type', $this->type);
        }

        return view('livewire.properties.list-properties', [
            'properties' => $query->latest()->paginate(9),
        ]);
    }
}
