<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class WatermarkService
{
    public static function apply(string $sourcePath, ?string $watermarkPath = null): void
    {
        if ($watermarkPath === null) {
            $settings = SiteSetting::getSingleton();
            if (! $settings->logo) {
                return;
            }
            $watermarkPath = Storage::disk('public')->path($settings->logo);
        }

        if (! file_exists($watermarkPath)) {
            return;
        }

        $manager = new ImageManager(new Driver());

        $image = $manager->read($sourcePath);
        $watermark = $manager->read($watermarkPath);

        $watermarkWidth = (int) ($image->width() * 0.4);
        $watermark->resize($watermarkWidth, null);

        $image->place(
            element: $watermark,
            position: 'center',
            offset_x: 0,
            offset_y: 0,
            opacity: 30
        );

        $image->save($sourcePath);
    }
}
