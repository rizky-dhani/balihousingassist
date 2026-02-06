<?php

namespace App\Models;

use App\Traits\InteractsWithSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    use InteractsWithSeo;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'bedroom',
        'bathroom',
        'images',
        'price_daily',
        'price_weekly',
        'price_monthly',
        'price_yearly',
        'is_available',
        'property_category_id',
        'property_location_id',
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
            'property_category_id' => 'integer',
            'property_location_id' => 'integer',
        ];
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id');
    }

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropertyLocation::class, 'property_location_id');
    }

    public function amenities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    /**
     * Generate the Schema.org JSON-LD for the property.
     */
    public function generateSchema(): ?array
    {
        $image = null;
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            $image = asset('storage/'.$this->images[0]);
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'RealEstateListing',
            'name' => $this->name,
            'description' => str($this->description)->limit(160)->toString(),
            'url' => route('properties.show', $this),
            'image' => $image,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $this->location?->name,
                'addressRegion' => 'Bali',
                'addressCountry' => 'ID',
            ],
            'numberOfRooms' => $this->bedroom,
        ];
    }
}
