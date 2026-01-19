<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyLocation extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyLocationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropertyLocation::class, 'parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PropertyLocation::class, 'parent_id');
    }
}
