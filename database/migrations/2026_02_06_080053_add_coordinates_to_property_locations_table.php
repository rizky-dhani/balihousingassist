<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('property_locations', function (Blueprint $blueprint) {
            $blueprint->decimal('latitude', 10, 8)->nullable()->after('name');
            $blueprint->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_locations', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['latitude', 'longitude']);
        });
    }
};
