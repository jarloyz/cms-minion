<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('sites') || Schema::hasColumn('sites', 'orden_secciones')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            $table->json('orden_secciones')->nullable()->after('servicios');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('sites') || ! Schema::hasColumn('sites', 'orden_secciones')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('orden_secciones');
        });
    }
};
