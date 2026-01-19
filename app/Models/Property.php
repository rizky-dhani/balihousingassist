<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'bedroom',
        'bathroom',
        'images',
        'price_daily',
        'price_weekly',
        'price_monthly',
        'price_yearly',
        'is_available',
    ];

    protected static function booted(): void
    {
        static::creating(function (Property $property) {
            $property->slug = Str::slug($property->name);
        });

        static::updating(function (Property $property) {
            if ($property->isDirty('name')) {
                $property->slug = Str::slug($property->name);
            }
        });
    }

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'price_daily' => 'integer',
            'price_weekly' => 'integer',
            'price_monthly' => 'integer',
            'price_yearly' => 'integer',
            'is_available' => 'boolean',
        ];
    }

    public function amenities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }
}
