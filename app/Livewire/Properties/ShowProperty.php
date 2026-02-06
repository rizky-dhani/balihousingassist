<?php

namespace App\Livewire\Properties;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;
use RalphJSmit\Laravel\SEO\TagManager;

#[Layout('layouts.app')]
class ShowProperty extends Component
{
    public Property $property;

    public function mount(Property $property)
    {
        $this->property = $property->load(['amenities', 'seo']);
    }

    public function render()
    {
        app(TagManager::class)->for($this->property);

        return view('livewire.properties.show-property', [
            'schema' => $this->property->generateSchema(),
        ]);
    }
}
