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
        if (! Schema::hasTable('sites') || Schema::hasColumn('sites', 'dominio')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            $table->string('dominio')->nullable()->unique()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('sites') || ! Schema::hasColumn('sites', 'dominio')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('dominio');
        });
    }
};
