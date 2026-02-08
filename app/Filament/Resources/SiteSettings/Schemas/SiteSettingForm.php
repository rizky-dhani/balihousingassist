<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo')
                    ->image()
                    ->columnSpanFull()
                    ->disk('public')
                    ->directory('site'),
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Social Media')
                            ->schema([
                                TextInput::make('facebook_url')
                                    ->label('Facebook')
                                    ->url(),
                                TextInput::make('twitter_url')
                                    ->label('Twitter')
                                    ->url(),
                                TextInput::make('instagram_url')
                                    ->label('Instagram')
                                    ->url(),
                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn')
                                    ->url(),
                                TextInput::make('whatsapp_number')
                                    ->label('WhatsApp')
                                    ->tel(),
                            ]),
                        Section::make('')
                            ->schema([
                                KeyValue::make('settings'),
                            ]),
                    ]),
            ]);
    }
}
