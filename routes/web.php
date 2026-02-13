<?php

use App\Livewire\Docs\GoogleAnalyticsSetup;
use App\Livewire\Properties\ListProperties;
use App\Livewire\Properties\ShowProperty;
use Illuminate\Support\Facades\Route;

Route::get('/', ListProperties::class)->name('home')->lazy();
Route::get('/properties', ListProperties::class)->name('properties.index')->lazy();
Route::get('/properties/{property:slug}', ShowProperty::class)->name('properties.show');
Route::get('/docs/google-analytics', GoogleAnalyticsSetup::class)->name('docs.google-analytics')->lazy();
