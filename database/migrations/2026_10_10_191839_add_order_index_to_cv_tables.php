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
        Schema::table('experiences', function (Blueprint $table) {
            $table->integer('order_index')->default(0)->after('description');
        });

        Schema::table('education', function (Blueprint $table) {
            $table->integer('order_index')->default(0)->after('description');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->integer('order_index')->default(0)->after('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('order_index');
        });

        Schema::table('education', function (Blueprint $table) {
            $table->dropColumn('order_index');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('order_index');
        });
    }
};
