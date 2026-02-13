<?php

namespace App\Livewire\Docs;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class GoogleAnalyticsSetup extends Component
{
    public function render()
    {
        return view('livewire.docs.google-analytics-setup');
    }
}
