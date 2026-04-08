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
            if (! Schema::hasColumn('sites', 'cta_config')) {
                $table->json('cta_config')->nullable()->after('orden_secciones');
            }

            if (! Schema::hasColumn('sites', 'social_links')) {
                $table->json('social_links')->nullable()->after('cta_config');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('sites')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            if (Schema::hasColumn('sites', 'social_links')) {
                $table->dropColumn('social_links');
            }

            if (Schema::hasColumn('sites', 'cta_config')) {
                $table->dropColumn('cta_config');
            }
        });
    }
};
