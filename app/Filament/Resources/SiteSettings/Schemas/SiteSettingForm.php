<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo')
                    ->image()
                    ->directory('site'),
                TextInput::make('facebook_url')
                    ->url(),
                TextInput::make('twitter_url')
                    ->url(),
                TextInput::make('instagram_url')
                    ->url(),
                TextInput::make('linkedin_url')
                    ->url(),
                TextInput::make('whatsapp_number'),
                KeyValue::make('settings'),
            ]);
    }
}
