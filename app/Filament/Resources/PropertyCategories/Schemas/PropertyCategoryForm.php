<?php

namespace App\Filament\Resources\PropertyCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PropertyCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('General Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state)))
                            ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('seo.title', $state)),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('SEO')
                    ->schema([
                        TextInput::make('seo.title')
                            ->label('SEO Title')
                            ->columnSpanFull(),
                        TextInput::make('seo.author')
                            ->label('Author')
                            ->columnSpanFull(),
                        Textarea::make('seo.description')
                            ->label('SEO Description')
                            ->columnSpanFull(),
                        Select::make('seo.robots')
                            ->label('Robots')
                            ->options([
                                'index, follow' => 'Index, Follow',
                                'index, nofollow' => 'Index, Nofollow',
                                'noindex, follow' => 'Noindex, Follow',
                                'noindex, nofollow' => 'Noindex, Nofollow',
                            ])
                            ->default('index, follow'),
                    ]),
            ]);
    }
}
