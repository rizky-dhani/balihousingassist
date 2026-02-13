<?php

namespace App\Models;

use App\Traits\InteractsWithSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PropertyLocation extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyLocationFactory> */
    use HasFactory;

    use InteractsWithSeo;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (PropertyLocation $location): void {
            if (empty($location->slug)) {
                $location->slug = Str::slug($location->name);
            }
        });

        static::updating(function (PropertyLocation $location): void {
            if ($location->isDirty('name') && empty($location->slug)) {
                $location->slug = Str::slug($location->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
