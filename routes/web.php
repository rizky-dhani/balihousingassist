<?php

use App\Livewire\Properties\ListProperties;
use App\Livewire\Properties\ShowProperty;
use Illuminate\Support\Facades\Route;

Route::get('/', ListProperties::class)->name('home');
Route::get('/properties', ListProperties::class)->name('properties.index');
Route::get('/properties/{property:slug}', ShowProperty::class)->name('properties.show');
