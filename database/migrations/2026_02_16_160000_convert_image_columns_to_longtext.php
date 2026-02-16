<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Convert all image columns from string (VARCHAR) to LONGTEXT
     * so they can store base64 data URIs on Vercel (read-only filesystem)
     */
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->longText('image')->nullable()->change();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->longText('image')->nullable()->change();
        });

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->longText('image')->nullable()->change();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->longText('logo')->nullable()->change();
            $table->longText('image')->nullable()->change();
        });

        Schema::table('alumni', function (Blueprint $table) {
            $table->longText('photo')->nullable()->change();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->longText('photo')->nullable()->change();
        });

        Schema::table('program_keahlians', function (Blueprint $table) {
            $table->longText('hero_image')->nullable()->change();
            $table->longText('overview_image')->nullable()->change();
        });

        Schema::table('website_settings', function (Blueprint $table) {
            $table->longText('value')->nullable()->change();
        });
    }

    /**
     * Reverse - convert back to VARCHAR
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->string('logo')->nullable()->change();
            $table->string('image')->nullable()->change();
        });

        Schema::table('alumni', function (Blueprint $table) {
            $table->string('photo')->nullable()->change();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('photo')->nullable()->change();
        });

        Schema::table('program_keahlians', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->change();
            $table->string('overview_image')->nullable()->change();
        });

        Schema::table('website_settings', function (Blueprint $table) {
            $table->string('value')->nullable()->change();
        });
    }
};
