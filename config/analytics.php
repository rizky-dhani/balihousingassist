<?php

return [

    'property_id' => env('ANALYTICS_PROPERTY_ID'),

    'service_account_credentials_json' => storage_path(env('GOOGLE_SERVICE_ACCOUNT_CREDENTIALS_JSON', 'app/analytics/service-account-credentials.json')),

    'cache_lifetime_in_minutes' => (int) env('ANALYTICS_CACHE_LIFETIME', 0),

    'cache' => [
        'store' => 'array',
    ],
];
