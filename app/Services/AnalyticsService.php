<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Illuminate\Support\Collection;
use Spatie\Analytics\Period;

class AnalyticsService
{
    protected BetaAnalyticsDataClient $client;

    protected string $propertyId;

    public function __construct(string $credentialsPath, string $propertyId)
    {
        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath,
            'transport' => 'rest',
        ]);
        $this->propertyId = $propertyId;

        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath,
            'transport' => 'rest',
        ]);
        $this->propertyId = $propertyId;
    }

    public function fetchTotalVisitorsAndPageViews(Period $period): Collection
    {
        $request = new RunReportRequest([
            'property' => "properties/{$this->propertyId}",
            'date_ranges' => [$period->toDateRange()],
            'metrics' => [
                new Metric(['name' => 'activeUsers']),
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'date']),
            ],
        ]);

        $response = $this->client->runReport($request);

        $result = collect();

        foreach ($response->getRows() as $row) {
            $dimensionValues = $row->getDimensionValues();
            $metricValues = $row->getMetricValues();

            $result->push([
                'date' => $dimensionValues[0]->getValue(),
                'visitors' => (int) $metricValues[0]->getValue(),
                'pageViews' => (int) $metricValues[1]->getValue(),
            ]);
        }

        return $result;
    }

    public function fetchMostVisitedPages(Period $period, int $maxResults = 20): Collection
    {
        $request = new RunReportRequest([
            'property' => "properties/{$this->propertyId}",
            'date_ranges' => [$period->toDateRange()],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'pagePath']),
                new Dimension(['name' => 'pageTitle']),
            ],
            'limit' => $maxResults,
            'order_bys' => [
                [
                    'metric' => ['metric_name' => 'screenPageViews'],
                    'desc' => true,
                ],
            ],
        ]);

        $response = $this->client->runReport($request);

        $result = collect();

        foreach ($response->getRows() as $row) {
            $dimensionValues = $row->getDimensionValues();
            $metricValues = $row->getMetricValues();

            $result->push([
                'fullPageUrl' => $dimensionValues[0]->getValue(),
                'pageTitle' => $dimensionValues[1]->getValue(),
                'screenPageViews' => (int) $metricValues[0]->getValue(),
            ]);
        }

        return $result;
    }

    public function fetchTopReferrers(Period $period, int $maxResults = 20): Collection
    {
        $request = new RunReportRequest([
            'property' => "properties/{$this->propertyId}",
            'date_ranges' => [$period->toDateRange()],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'pageReferrer']),
            ],
            'limit' => $maxResults,
            'order_bys' => [
                [
                    'metric' => ['metric_name' => 'screenPageViews'],
                    'desc' => true,
                ],
            ],
        ]);

        $response = $this->client->runReport($request);

        $result = collect();

        foreach ($response->getRows() as $row) {
            $dimensionValues = $row->getDimensionValues();
            $metricValues = $row->getMetricValues();

            $result->push([
                'pageReferrer' => $dimensionValues[0]->getValue(),
                'screenPageViews' => (int) $metricValues[0]->getValue(),
            ]);
        }

        return $result;
    }

    public function fetchTopCountries(Period $period, int $maxResults = 10): Collection
    {
        $request = new RunReportRequest([
            'property' => "properties/{$this->propertyId}",
            'date_ranges' => [$period->toDateRange()],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'country']),
            ],
            'limit' => $maxResults,
            'order_bys' => [
                [
                    'metric' => ['metric_name' => 'screenPageViews'],
                    'desc' => true,
                ],
            ],
        ]);

        $response = $this->client->runReport($request);

        $result = collect();

        foreach ($response->getRows() as $row) {
            $dimensionValues = $row->getDimensionValues();
            $metricValues = $row->getMetricValues();

            $result->push([
                'country' => $dimensionValues[0]->getValue(),
                'screenPageViews' => (int) $metricValues[0]->getValue(),
            ]);
        }

        return $result;
    }

    public function fetchTopBrowsers(Period $period, int $maxResults = 10): Collection
    {
        $request = new RunReportRequest([
            'property' => "properties/{$this->propertyId}",
            'date_ranges' => [$period->toDateRange()],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'browser']),
            ],
            'limit' => $maxResults,
            'order_bys' => [
                [
                    'metric' => ['metric_name' => 'screenPageViews'],
                    'desc' => true,
                ],
            ],
        ]);

        $response = $this->client->runReport($request);

        $result = collect();

        foreach ($response->getRows() as $row) {
            $dimensionValues = $row->getDimensionValues();
            $metricValues = $row->getMetricValues();

            $result->push([
                'browser' => $dimensionValues[0]->getValue(),
                'screenPageViews' => (int) $metricValues[0]->getValue(),
            ]);
        }

        return $result;
    }

    public function fetchTopOperatingSystems(Period $period, int $maxResults = 10): Collection
    {
        $request = new RunReportRequest([
            'property' => "properties/{$this->propertyId}",
            'date_ranges' => [$period->toDateRange()],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'operatingSystem']),
            ],
            'limit' => $maxResults,
            'order_bys' => [
                [
                    'metric' => ['metric_name' => 'screenPageViews'],
                    'desc' => true,
                ],
            ],
        ]);

        $response = $this->client->runReport($request);

        $result = collect();

        foreach ($response->getRows() as $row) {
            $dimensionValues = $row->getDimensionValues();
            $metricValues = $row->getMetricValues();

            $result->push([
                'operatingSystem' => $dimensionValues[0]->getValue(),
                'screenPageViews' => (int) $metricValues[0]->getValue(),
            ]);
        }

        return $result;
    }
}
