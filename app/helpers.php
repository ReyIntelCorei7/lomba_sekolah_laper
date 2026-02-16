<?php

if (!function_exists('display_image')) {
    /**
     * Return the correct image URL for display.
     * Handles: base64 data URIs, storage paths, and direct asset paths.
     *
     * @param string|null $value The image value from the database
     * @param string|null $fallback Optional fallback image path (relative to public/)
     * @return string|null
     */
    function display_image(?string $value, ?string $fallback = null): ?string
    {
        if (empty($value)) {
            return $fallback ? asset($fallback) : null;
        }

        // If it's already a base64 data URI, return as-is
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
