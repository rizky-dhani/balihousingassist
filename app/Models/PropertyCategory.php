<?php

namespace App\Models;

use App\Traits\InteractsWithSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyCategoryFactory> */
    use HasFactory;

    use InteractsWithSeo;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function getSeoAuthor(): ?string
    {
        return \Illuminate\Support\Facades\Auth::user()?->name;
    }
}
