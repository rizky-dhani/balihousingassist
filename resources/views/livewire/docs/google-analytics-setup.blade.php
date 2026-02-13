<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-8">Google Analytics Setup Guide</h1>
    
    <p class="text-lg text-gray-600 mb-8">This guide will help you configure Google Analytics for your application to track website traffic and user behavior.</p>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Prerequisites</h2>
    <ul class="list-disc list-inside space-y-2 text-gray-600 mb-6">
        <li>A Google Analytics 4 (GA4) property</li>
        <li>A Google Cloud Platform project with billing enabled</li>
        <li>Access to your application's <code class="bg-gray-100 px-2 py-1 rounded">.env</code> file</li>
    </ul>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Environment Variables</h2>
    <p class="text-gray-600 mb-4">Add the following variables to your <code class="bg-gray-100 px-2 py-1 rounded">.env</code> file:</p>

    <div class="bg-gray-900 text-gray-100 p-4 rounded-lg my-6">
        <pre class="text-sm overflow-x-auto"><code>ANALYTICS_TRACKING_ID=GA_MEASUREMENT_ID
ANALYTICS_PROPERTY_ID=PROPERTY_ID
ANALYTICS_SERVICE_ACCOUNT_KEY=path/to/service-account.json</code></pre>
    </div>

    <h3 class="text-xl font-semibold mt-8 mb-4">Variable Descriptions</h3>
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Variable</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Description</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Example</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-3"><code class="bg-gray-100 px-2 py-1 rounded text-sm">ANALYTICS_TRACKING_ID</code></td>
                    <td class="px-4 py-3 text-gray-600">GA4 Measurement ID</td>
                    <td class="px-4 py-3"><code class="bg-gray-100 px-2 py-1 rounded text-sm">G-XXXXXXXXXX</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-3"><code class="bg-gray-100 px-2 py-1 rounded text-sm">ANALYTICS_PROPERTY_ID</code></td>
                    <td class="px-4 py-3 text-gray-600">Google Analytics Property ID (numeric)</td>
                    <td class="px-4 py-3"><code class="bg-gray-100 px-2 py-1 rounded text-sm">123456789</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-3"><code class="bg-gray-100 px-2 py-1 rounded text-sm">ANALYTICS_SERVICE_ACCOUNT_KEY</code></td>
                    <td class="px-4 py-3 text-gray-600">Path to service account JSON file</td>
                    <td class="px-4 py-3"><code class="bg-gray-100 px-2 py-1 rounded text-sm">storage/app/analytics.json</code></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 1: Create a GA4 Property</h2>
    <ol class="list-decimal list-inside space-y-2 text-gray-600 mb-6">
        <li>Go to <a href="https://analytics.google.com" target="_blank" class="text-primary-600 hover:underline">Google Analytics</a></li>
        <li>Sign in with your Google account</li>
        <li>Click <strong>Start measuring</strong></li>
        <li>Enter your website name and URL</li>
        <li>Select <strong>Web</strong> as the platform</li>
        <li>Create your GA4 property</li>
    </ol>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 2: Get Your Measurement ID</h2>
    <ol class="list-decimal list-inside space-y-2 text-gray-600 mb-6">
        <li>In Google Analytics, go to <strong>Admin</strong> (gear icon)</li>
        <li>Click <strong>Data Streams</strong> under your property</li>
        <li>Click on your web data stream</li>
        <li>Copy the <strong>Measurement ID</strong> (format: G-XXXXXXXXXX)</li>
    </ol>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 3: Create a Service Account</h2>
    <ol class="list-decimal list-inside space-y-2 text-gray-600 mb-6">
        <li>Go to <a href="https://console.cloud.google.com" target="_blank" class="text-primary-600 hover:underline">Google Cloud Console</a></li>
        <li>Create a new project or select an existing one</li>
        <li>Navigate to <strong>IAM & Admin</strong> → <strong>Service Accounts</strong></li>
        <li>Click <strong>Create Service Account</strong></li>
        <li>Enter a name and description</li>
        <li>Copy the <strong>Service Account Email</strong> (you'll need this later)</li>
    </ol>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 4: Enable Analytics Reporting API</h2>
    <ol class="list-decimal list-inside space-y-2 text-gray-600 mb-6">
        <li>In Google Cloud Console, go to <strong>APIs & Services</strong> → <strong>Library</strong></li>
        <li>Search for <strong>Google Analytics Reporting API</strong></li>
        <li>Click on it and click <strong>Enable</strong></li>
    </ol>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 5: Generate JSON Key</h2>
    <ol class="list-decimal list-inside space-y-2 text-gray-600 mb-6">
        <li>In Service Accounts list, click on your newly created service account</li>
        <li>Go to <strong>Keys</strong> tab</li>
        <li>Click <strong>Add Key</strong> → <strong>Create new key</strong></li>
        <li>Select <strong>JSON</strong> format</li>
        <li>Download the file and save it to <code class="bg-gray-100 px-2 py-1 rounded">storage/app/</code> in your project</li>
    </ol>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 6: Grant Access in GA4</h2>
    <ol class="list-decimal list-inside space-y-2 text-gray-600 mb-6">
        <li>Go back to Google Analytics</li>
        <li>Go to <strong>Admin</strong> → <strong>Property Access Management</strong></li>
        <li>Click <strong>+ Add users</strong></li>
        <li>Paste the Service Account Email from Step 3</li>
        <li>Select <strong>Viewer</strong> role</li>
        <li>Click <strong>Add</strong></li>
    </ol>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 7: Update .env File</h2>
    <p class="text-gray-600 mb-4">Add or update these variables in your <code class="bg-gray-100 px-2 py-1 rounded">.env</code> file:</p>
    <div class="bg-gray-900 text-gray-100 p-4 rounded-lg my-6">
        <pre class="text-sm overflow-x-auto"><code>ANALYTICS_TRACKING_ID=G-XXXXXXXXXX
ANALYTICS_PROPERTY_ID=123456789
ANALYTICS_SERVICE_ACCOUNT_KEY=storage/app/your-service-account.json</code></pre>
    </div>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Step 8: Clear Cache</h2>
    <p class="text-gray-600 mb-4">Run the following command to apply the changes:</p>
    <div class="bg-gray-900 text-gray-100 p-4 rounded-lg my-6">
        <pre class="text-sm overflow-x-auto"><code>php artisan config:clear</code></pre>
    </div>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Verifying the Setup</h2>
    <p class="text-gray-600 mb-6">After configuration, visit the <a href="{{ route('filament.dashboard.pages.analytics') }}" class="text-primary-600 hover:underline">Analytics page</a> in your admin panel. You should see your analytics data displayed in the widgets.</p>

    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 my-8">
        <p class="font-semibold text-blue-800">Note:</p>
        <p class="text-blue-700 mt-2">It may take up to 24-48 hours for data to appear in Google Analytics after initial setup. The tracking code needs to receive visitors before data will show.</p>
    </div>

    <h2 class="text-2xl font-semibold mt-12 mb-4">Troubleshooting</h2>
    <h3 class="text-xl font-semibold mt-6 mb-3">No data showing?</h3>
    <ul class="list-disc list-inside space-y-2 text-gray-600 mb-6">
        <li>Verify your Measurement ID is correct</li>
        <li>Check that the tracking script is installed on your site</li>
        <li>Wait 24-48 hours for data to populate</li>
    </ul>

    <h3 class="text-xl font-semibold mt-6 mb-3">Permission errors?</h3>
    <ul class="list-disc list-inside space-y-2 text-gray-600 mb-12">
        <li>Ensure the service account has Viewer access in GA4</li>
        <li>Verify the JSON key file path is correct</li>
        <li>Check that the Analytics Reporting API is enabled</li>
    </ul>
</div>
