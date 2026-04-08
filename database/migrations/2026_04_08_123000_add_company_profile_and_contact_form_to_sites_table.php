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
            if (! Schema::hasColumn('sites', 'company_profile')) {
                $table->json('company_profile')->nullable()->after('contacto_config');
            }

            if (! Schema::hasColumn('sites', 'contact_form_config')) {
                $table->json('contact_form_config')->nullable()->after('company_profile');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('sites')) {
            return;
        }

        Schema::table('sites', function (Blueprint $table) {
            if (Schema::hasColumn('sites', 'contact_form_config')) {
                $table->dropColumn('contact_form_config');
            }

            if (Schema::hasColumn('sites', 'company_profile')) {
                $table->dropColumn('company_profile');
            }
        });
    }
};
