<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
        'location',
        'address',
        'price_daily',
        'price_weekly',
        'price_monthly',
        'price_yearly',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'price_daily' => 'integer',
            'price_weekly' => 'integer',
            'price_monthly' => 'integer',
            'price_yearly' => 'integer',
            'is_available' => 'boolean',
        ];
    }
}
