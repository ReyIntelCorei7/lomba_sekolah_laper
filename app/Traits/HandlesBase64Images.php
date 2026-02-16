<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandlesBase64Images
{
    /**
     * Convert an uploaded file to a base64 data URI string
     */
    protected function convertToBase64(UploadedFile $file): string
    {
        $contents = file_get_contents($file->getRealPath());
        $mimeType = $file->getMimeType();
        return 'data:' . $mimeType . ';base64,' . base64_encode($contents);
    }

    /**
     * Process image upload: convert to base64 if file exists, else return null
     */
    protected function processImageUpload($request, string $fieldName): ?string
    {
        if ($request->hasFile($fieldName) && $request->file($fieldName)->isValid()) {
            return $this->convertToBase64($request->file($fieldName));
        }
        return null;
    }
}
