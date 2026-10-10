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
        Schema::table('cv_profiles', function (Blueprint $table) {
            $table->boolean('show_education')->default(true)->after('theme_color');
            $table->boolean('show_experience')->default(true)->after('show_education');
            $table->boolean('show_skills')->default(true)->after('show_experience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cv_profiles', function (Blueprint $table) {
            $table->dropColumn(['show_education', 'show_experience', 'show_skills']);
        });
    }
};
