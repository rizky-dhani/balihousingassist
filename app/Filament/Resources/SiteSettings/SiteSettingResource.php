<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\CreateSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSiteSettings;
use App\Models\SiteSetting;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('General Settings')
                    ->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->directory('site')
                            ->columnSpanFull(),
                    ]),
                Section::make('Social Media & Contact')
                    ->columns(2)
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url(),
                        TextInput::make('twitter_url')
                            ->label('Twitter URL')
                            ->url(),
                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url(),
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url(),
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp Number')
                            ->columnSpanFull()
                            ->tel()
                            ->helperText('Format: 628123456789'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo'),
                TextColumn::make('facebook_url')
                    ->label('Facebook')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteSettings::route('/'),
            'create' => CreateSiteSetting::route('/create'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
