<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $fillable = [
        'parent_id',
        'label',
        'url',
        'order',
        'new_tab',
    ];

    protected function casts(): array
    {
        return [
            'new_tab' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Navigation::class, 'parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Navigation::class, 'parent_id')->orderBy('order');
    }
}
