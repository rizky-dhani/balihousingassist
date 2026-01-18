<?php

namespace App\Livewire\Properties;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ShowProperty extends Component
{
    public Property $property;

    public function mount(Property $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        return view('livewire.properties.show-property')
            ->title($this->property->name . ' - Bali Housing Assist');
    }
}
