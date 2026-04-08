<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('sites')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            if (! Schema::hasColumn('sites', 'seo_config')) {
                $table->json('seo_config')->nullable()->after('orden_secciones');
            }

            if (! Schema::hasColumn('sites', 'tracking_config')) {
                $table->json('tracking_config')->nullable()->after('seo_config');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('sites')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            if (Schema::hasColumn('sites', 'tracking_config')) {
                $table->dropColumn('tracking_config');
            }

            if (Schema::hasColumn('sites', 'seo_config')) {
                $table->dropColumn('seo_config');
            }
        });
    }
};
