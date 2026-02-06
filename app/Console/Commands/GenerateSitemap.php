<?php

namespace App\Console\Commands;

use App\Models\Property;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for the application';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create();

        // Static Pages
        $sitemap->add(Url::create(route('home'))
            ->setPriority(1.0)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        $sitemap->add(Url::create(route('properties.index'))
            ->setPriority(0.9)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        // Dynamic Property Pages
        Property::query()
            ->where('is_available', true)
            ->cursor()
            ->each(function (Property $property) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('properties.show', $property))
                        ->setPriority(0.8)
                        ->setLastModificationDate($property->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                );
            });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
