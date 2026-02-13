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
            'description' => $this->getSeoDescription(),
            'author' => $this->getSeoAuthor(),
            'robots' => $this->getSeoRobots() ?? 'index, follow',
        ]);

        return $this;
    }

    protected function getSeoDescription(): ?string
    {
        $description = $this->description ?? '';

        if (is_array($description)) {
            $description = implode(' ', $description);
        }

        return str($description)->limit(160)->trim()->toString() ?: null;
    }

    protected function getSeoAuthor(): ?string
    {
        return null;
    }

    protected function getSeoRobots(): ?string
    {
        return 'index, follow';
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

    /**
     * Generate the Schema.org JSON-LD for the model.
     */
    public function generateSchema(): ?array
    {
        return null;
    }
}
