<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class MapPicker extends Field
{
    protected string $view = 'forms.components.map-picker';

    public string $latitudeField = 'latitude';

    public string $longitudeField = 'longitude';

    public ?string $addressField = null;

    public string $height = '400px';

    public string $width = '100%';

    public int $zoom = 12;

    public float $defaultLat = -8.6478; // Default Bali

    public float $defaultLng = 115.1385;

    public string $tileLayer = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

    public string $attribution = '© OpenStreetMap contributors';

    public bool $isDraggable = true;

    public bool $isClickable = true;

    public function latitudeField(string $field): static
    {
        $this->latitudeField = $field;

        return $this;
    }

    public function longitudeField(string $field): static
    {
        $this->longitudeField = $field;

        return $this;
    }

    public function addressField(string $field): static
    {
        $this->addressField = $field;

        return $this;
    }

    public function height(string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function width(string $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function zoom(int $zoom): static
    {
        $this->zoom = $zoom;

        return $this;
    }

    public function defaultLocation(float $latitude, float $longitude): static
    {
        $this->defaultLat = $latitude;
        $this->defaultLng = $longitude;

        return $this;
    }

    public function tileLayer(string $url, string $attribution = ''): static
    {
        $this->tileLayer = $url;
        if ($attribution) {
            $this->attribution = $attribution;
        }

        return $this;
    }

    public function draggable(bool $condition = true): static
    {
        $this->isDraggable = $condition;

        return $this;
    }

    public function clickable(bool $condition = true): static
    {
        $this->isClickable = $condition;

        return $this;
    }

    public function getLatitudeField(): string
    {
        return $this->latitudeField;
    }

    public function getLongitudeField(): string
    {
        return $this->longitudeField;
    }

    public function getAddressField(): ?string
    {
        return $this->addressField;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function getZoom(): int
    {
        return $this->zoom;
    }

    public function getDefaultLat(): float
    {
        return $this->defaultLat;
    }

    public function getDefaultLng(): float
    {
        return $this->defaultLng;
    }

    public function getTileLayer(): string
    {
        return $this->tileLayer;
    }

    public function getAttribution(): string
    {
        return $this->attribution;
    }

    public function getIsDraggable(): bool
    {
        return $this->isDraggable;
    }

    public function getIsClickable(): bool
    {
        return $this->isClickable;
    }
}
