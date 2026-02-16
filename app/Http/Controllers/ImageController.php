<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    /**
     * Serve an image stored as base64 in the database.
     * URL: /img/{table}/{id}/{column}
     */
    public function show(string $table, int $id, string $column)
    {
        // Whitelist allowed tables and columns for security
        $allowed = [
            'programs' => ['image'],
            'news' => ['image'],
            'extracurriculars' => ['image'],
            'organizations' => ['logo', 'image'],
            'alumni' => ['photo'],
            'students' => ['photo'],
            'program_keahlians' => ['hero_image', 'overview_image'],
            'website_settings' => ['value'],
        ];

        if (!isset($allowed[$table]) || !in_array($column, $allowed[$table])) {
            abort(404);
        }

        $record = DB::table($table)->where('id', $id)->value($column);

        if (!$record) {
            abort(404);
        }

        // If it's a base64 data URI, decode and serve
        if (str_starts_with($record, 'data:')) {
            // Parse: data:image/png;base64,iVBOR...
            if (preg_match('/^data:(image\/[a-zA-Z+]+);base64,(.+)$/', $record, $matches)) {
                $mimeType = $matches[1];
                $imageData = base64_decode($matches[2]);

                return response($imageData, 200)
                    ->header('Content-Type', $mimeType)
                    ->header('Cache-Control', 'public, max-age=31536000');
            }
        }

        // Not base64, redirect to storage URL
        return redirect(asset('storage/' . $record));
    }
}
