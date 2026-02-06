<?php

namespace App\Filament\Resources\PropertyCategories\Schemas;

use Filament\Schemas\Schema;
use RalphJSmit\Filament\SEO\SEO;

class PropertyCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('General Information')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        \Filament\Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('SEO')
                    ->schema([
                        SEO::make(),
                    ]),
            ]);
    }
}
