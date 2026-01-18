<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(Request $request): View
    {
        $query = Property::query()->where('is_available', true);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('location')) {
            $query->where('location', $request->location);
        }

        $properties = $query->latest()->paginate(9);

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property): View
    {
        return view('properties.show', ['property' => $property]);
    }
}
