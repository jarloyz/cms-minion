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
            if (! Schema::hasColumn('sites', 'hero_config')) {
                $table->json('hero_config')->nullable()->after('tracking_config');
            }

            if (! Schema::hasColumn('sites', 'contacto_config')) {
                $table->json('contacto_config')->nullable()->after('hero_config');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('sites')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            if (Schema::hasColumn('sites', 'contacto_config')) {
                $table->dropColumn('contacto_config');
            }

            if (Schema::hasColumn('sites', 'hero_config')) {
                $table->dropColumn('hero_config');
            }
        });
    }
};
