<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Forms\Components\MapPicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Basic Information')
                        ->schema([
                            TextInput::make('name')
                                ->columnSpanFull()
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('seo.title', $state)),
                            Select::make('property_category_id')
                                ->relationship('category', 'name')
                                ->required(),
                            Select::make('property_location_id')
                                ->relationship('location', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Textarea::make('description')
                                ->default(null)
                                ->columnSpanFull()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('seo.description', $state)),

                            Section::make('Search Engine Optimization (SEO)')
                                ->description('Manage how this property appears in search results.')
                                ->collapsed()
                                ->columnSpanFull()
                                ->schema([
                                    TextInput::make('title')
                                        ->label('SEO Title')
                                        ->placeholder('Defaults to Property Name')
                                        ->columnSpanFull(),
                                    Textarea::make('description')
                                        ->label('SEO Description')
                                        ->placeholder('Defaults to Property Description')
                                        ->columnSpanFull(),
                                    TextInput::make('author')
                                        ->label('Author')
                                        ->default(fn () => auth()->user()?->name)
                                        ->columnSpanFull(),
                                    Select::make('robots')
                                        ->label('Robots')
                                        ->options([
                                            'index, follow' => 'Index, Follow',
                                            'index, nofollow' => 'Index, Nofollow',
                                            'noindex, follow' => 'Noindex, Follow',
                                            'noindex, nofollow' => 'Noindex, Nofollow',
                                        ])
                                        ->helperText(fn (?string $state): ?string => match ($state) {
                                            'index, follow' => 'Allow search engines to index the page and follow links. (Recommended)',
                                            'index, nofollow' => 'Index the page but do not follow links.',
                                            'noindex, follow' => 'Do not index the page but follow links.',
                                            'noindex, nofollow' => 'Do not index the page and do not follow links.',
                                            default => null,
                                        })
                                        ->default('index, follow')
                                        ->live()
                                        ->columnSpanFull(),
                                ])
                                ->statePath('seo')
                                ->afterStateHydrated(function ($component, ?Model $record) {
                                    if ($record?->seo) {
                                        $component->getChildSchema()->fill($record->seo->toArray());
                                    }
                                })
                                ->saveRelationshipsUsing(function (Model $record, array $state): void {
                                    $record->seo()->updateOrCreate([], $state);
                                }),
                        ])->columns(2),
                    Step::make('Details & Amenities')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Section::make('Bedroom & Bathroom')
                                        ->columns(2)
                                        ->schema([
                                            TextInput::make('bedroom')
                                                ->numeric()
                                                ->default(0),
                                            TextInput::make('bathroom')
                                                ->numeric()
                                                ->step(0.5)
                                                ->default(0),
                                            TimePicker::make('check_in_time')
                                                ->label('Check In')
                                                ->default('14:00')
                                                ->required(),
                                            TimePicker::make('check_out_time')
                                                ->label('Check Out')
                                                ->default('12:00')
                                                ->required(),
                                            Section::make('Amenities')
                                                ->schema([
                                                    CheckboxList::make('amenities')
                                                        ->relationship('amenities', 'name')
                                                        ->searchable()
                                                        ->columns(4),
                                                ])
                                                ->columnSpanFull(),
                                        ]),
                                    Section::make('Property Location (Map)')
                                        ->description('Drag the marker or click on the map to set the exact coordinates.')
                                        ->schema([
                                            MapPicker::make('location_picker')
                                                ->label('')
                                                ->tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png')
                                                ->latitudeField('latitude')
                                                ->longitudeField('longitude')
                                                ->addressField('address')
                                                ->height('645px')
                                                ->zoom(15)
                                                ->clickable()
                                                ->draggable()
                                                ->columnSpanFull(),
                                            TextInput::make('address')
                                                ->columnSpanFull(),
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('latitude')
                                                        ->numeric()
                                                        ->step(0.00000001)
                                                        ->live()
                                                        ->placeholder('e.g., -8.6478'),
                                                    TextInput::make('longitude')
                                                        ->numeric()
                                                        ->step(0.00000001)
                                                        ->live()
                                                        ->placeholder('e.g., 115.1385'),
                                                ]),
                                        ]),
                                ]),
                        ]),
                    Step::make('Pricing & Images')
                        ->schema([
                            Section::make('Pricing')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('price_daily')
                                        ->label('Daily')
                                        ->prefix('Rp')
                                        ->mask(RawJs::make('$money($input, ",", ".", 0)'))
                                        ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : null)
                                        ->dehydrateStateUsing(fn ($state) => $state ? (int) str_replace('.', '', $state) : null)
                                        ->default(null),
                                    TextInput::make('price_weekly')
                                        ->label('Weekly')
                                        ->prefix('Rp')
                                        ->mask(RawJs::make('$money($input, ",", ".", 0)'))
                                        ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : null)
                                        ->dehydrateStateUsing(fn ($state) => $state ? (int) str_replace('.', '', $state) : null)
                                        ->default(null),
                                    TextInput::make('price_monthly')
                                        ->label('Monthly')
                                        ->prefix('Rp')
                                        ->mask(RawJs::make('$money($input, ",", ".", 0)'))
                                        ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : null)
                                        ->dehydrateStateUsing(fn ($state) => $state ? (int) str_replace('.', '', $state) : null)
                                        ->default(null),
                                    TextInput::make('price_yearly')
                                        ->label('Yearly')
                                        ->prefix('Rp')
                                        ->mask(RawJs::make('$money($input, ",", ".", 0)'))
                                        ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : null)
                                        ->dehydrateStateUsing(fn ($state) => $state ? (int) str_replace('.', '', $state) : null)
                                        ->default(null),
                                ]),
                            FileUpload::make('main_image')
                                ->label('Main Property Image')
                                ->image()
                                ->disk('public')
                                ->directory(fn (Get $get): string => 'properties/'.Str::slug($get('name') ?? 'default'))
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                    $name = Str::slug($get('name') ?? 'property');
                                    $extension = $file->getClientOriginalExtension();
                                    $directory = "properties/{$name}";

                                    return "{$name}-main.{$extension}";
                                })
                                ->columnSpanFull(),
                            FileUpload::make('images')
                                ->multiple()
                                ->reorderable()
                                ->image()
                                ->disk('public')
                                ->directory(fn (Get $get): string => 'properties/'.Str::slug($get('name') ?? 'default'))
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                    $name = Str::slug($get('name') ?? 'property');
                                    $extension = $file->getClientOriginalExtension();
                                    $directory = "properties/{$name}";

                                    $files = Storage::disk('public')->files($directory);
                                    $count = count($files) + 1;

                                    while (Storage::disk('public')->exists("{$directory}/{$name}-{$count}.{$extension}")) {
                                        $count++;
                                    }

                                    return "{$name}-{$count}.{$extension}";
                                })
                                ->columnSpanFull(),
                            Toggle::make('is_available')
                                ->required(),
                            Toggle::make('is_featured')
                                ->label('Featured Property')
                                ->required(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
