<?php

namespace App\Traits;

use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

trait InteractsWithSeo
{
    use HasSEO {
        addSEO as parentAddSEO;
    }

    /**
     * Create the SEO record with initial data from the model.
     */
    public function addSEO(): static
    {
        $this->seo()->create([
            'title' => $this->name ?? $this->title ?? null,
            'description' => str($this->description ?? '')->limit(160)->trim()->toString() ?: null,
        ]);

        return $this;
    }

    /**
     * Get the dynamic SEO data for the model.
     * We use this for fields that aren't in the SEO table or as a last resort.
     */
    public function getDynamicSEOData(): SEOData
    {
        $image = null;

        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            $image = asset('storage/'.$this->images[0]);
        }

        return new SEOData(
            image: $image,
        );
    }
}
