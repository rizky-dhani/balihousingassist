<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'logo',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'whatsapp_number',
        'settings',
    ];

    protected function casts(): array
    {
        return [
            'settings' => 'array',
        ];
    }

    public static function getSingleton(): self
    {
        $singleton = static::find(1);

        if (! $singleton) {
            $singleton = new static;
            $singleton->id = 1;
            $singleton->save();
        }

        return $singleton;
    }
}
