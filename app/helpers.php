<?php

if (!function_exists('display_image')) {
    /**
     * Return the correct image URL for display.
     * For base64 data stored in DB, returns a URL to the image API endpoint.
     * For file paths, returns the storage URL.
     * For full URLs, returns as-is.
     *
     * @param string|null $value The image value from the database
     * @param string|null $fallback Optional fallback image path (relative to public/)
     * @param string|null $table Table name (required for base64 serving)
     * @param int|null $id Record ID (required for base64 serving)
     * @param string|null $column Column name (required for base64 serving)
     * @return string|null
     */
    function display_image(?string $value, ?string $fallback = null, ?string $table = null, ?int $id = null, ?string $column = null): ?string
    {
        if (empty($value)) {
            return $fallback ? asset($fallback) : null;
        }

        // If it's a base64 data URI and we have table info, return API URL
        if (str_starts_with($value, 'data:') && $table && $id && $column) {
            return url("/img/{$table}/{$id}/{$column}");
        }

        // If it's a base64 data URI without table info, return as-is (fallback)
        if (str_starts_with($value, 'data:')) {
            return $value;
        }

        // If it's a full URL, return as-is
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        // Otherwise it's a storage path (legacy data), try storage URL
        return asset('storage/' . $value);
    }
}

if (!function_exists('img_url')) {
    /**
     * Shorthand to generate image URL for a model's image field.
     * Always returns a URL to the /img API endpoint if the value exists.
     *
     * @param string|null $value The image value from DB
     * @param string $table The database table name
     * @param int $id The record ID
     * @param string $column The column name
     * @param string|null $fallback Fallback image path
     * @return string|null
     */
    function img_url(?string $value, string $table, int $id, string $column, ?string $fallback = null): ?string
    {
        if (empty($value)) {
            return $fallback ? asset($fallback) : null;
        }

        // If it's a base64 data URI, serve via API
        if (str_starts_with($value, 'data:')) {
            return url("/img/{$table}/{$id}/{$column}");
        }

        // If it's a full URL
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        // Legacy storage path
        return asset('storage/' . $value);
    }
}
