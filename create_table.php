<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

// Create website_settings table
if (!Schema::hasTable('website_settings')) {
    Schema::create('website_settings', function (Blueprint $table) {
        $table->id();
        $table->string('key')->unique();
        $table->text('value')->nullable();
        $table->string('type')->default('text');
        $table->string('group')->default('general');
        $table->string('label');
        $table->text('description')->nullable();
        $table->timestamps();
    });
    
    // Insert default settings
    DB::table('website_settings')->insert([
        [
            'key' => 'hero_title',
            'value' => 'Bridging the Gap Between Education & Industry',
            'type' => 'text',
            'group' => 'hero',
            'label' => 'Hero Title',
            'description' => 'Main title on the hero section',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'key' => 'hero_subtitle',
            'value' => 'The High Standard in Vocational Education',
            'type' => 'text',
            'group' => 'hero',
            'label' => 'Hero Subtitle',
            'description' => 'Subtitle/badge on the hero section',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    
    echo "✓ Table 'website_settings' created successfully with default data.\n";
} else {
    echo "! Table 'website_settings' already exists.\n";
}
