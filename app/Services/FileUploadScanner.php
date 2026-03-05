<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileUploadScanner
{
    /**
     * Allowed MIME types for images
     */
    protected array $allowedImageMimes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
    ];

    /**
     * Allowed MIME types for documents
     */
    protected array $allowedDocumentMimes = [
        'application/pdf',
        'image/jpeg',
        'image/png',
    ];

    /**
     * Dangerous file extensions
     */
    protected array $dangerousExtensions = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'phps', 'phar',
        'exe', 'bat', 'cmd', 'com', 'vbs', 'vbe', 'js', 'jse',
        'wsf', 'wsh', 'ps1', 'ps2', 'scr', 'msi', 'msp', 'mst',
        'cpl', 'hta', 'inf', 'ins', 'isp', 'lnk', 'sct', 'shb',
        'shs', 'ws', 'wsc', 'pif', 'reg', 'rgs', 'sh', 'bash',
        'csh', 'py', 'pl', 'rb', 'asp', 'aspx', 'jsp', 'cfm',
        'htaccess', 'htpasswd', 'svg',
    ];

    /**
     * Known dangerous file signatures (magic bytes)
     */
    protected array $dangerousSignatures = [
        '<?php',
        '<?=',
        '<script',
        '#!/',
        'MZ', // Windows executable
    ];

    /**
     * Max file size in bytes (10MB default)
     */
    protected int $maxFileSize = 10485760;

    /**
     * Scan an uploaded file for security threats
     */
    public function scan(UploadedFile $file, string $type = 'image'): array
    {
        $results = [];

        // 1. Check file size
        $sizeCheck = $this->checkFileSize($file);
        if (!$sizeCheck['safe']) return $sizeCheck;

        // 2. Check extension
        $extensionCheck = $this->checkExtension($file);
        if (!$extensionCheck['safe']) return $extensionCheck;

        // 3. Check for double extension (e.g. file.php.jpg)
        $doubleExtCheck = $this->checkDoubleExtension($file);
        if (!$doubleExtCheck['safe']) return $doubleExtCheck;

        // 4. Check MIME type
        $mimeCheck = $this->checkMimeType($file, $type);
        if (!$mimeCheck['safe']) return $mimeCheck;

        // 5. Check file content for dangerous patterns
        $contentCheck = $this->checkFileContent($file);
        if (!$contentCheck['safe']) return $contentCheck;

        // 6. Verify MIME matches extension
        $consistencyCheck = $this->checkMimeExtensionConsistency($file);
        if (!$consistencyCheck['safe']) return $consistencyCheck;

        return ['safe' => true, 'reason' => 'File passed all security checks'];
    }

    protected function checkFileSize(UploadedFile $file): array
    {
        if ($file->getSize() > $this->maxFileSize) {
            return [
                'safe' => false,
                'reason' => 'File size exceeds maximum allowed size of ' . ($this->maxFileSize / 1048576) . 'MB'
            ];
        }
        return ['safe' => true, 'reason' => ''];
    }

    protected function checkExtension(UploadedFile $file): array
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (in_array($extension, $this->dangerousExtensions)) {
            return [
                'safe' => false,
                'reason' => "File extension '.{$extension}' is not allowed"
            ];
        }
        return ['safe' => true, 'reason' => ''];
    }

    protected function checkDoubleExtension(UploadedFile $file): array
    {
        $filename = $file->getClientOriginalName();
        $parts = explode('.', $filename);

        if (count($parts) > 2) {
            // Check if any part before the last extension is dangerous
            array_pop($parts); // Remove last extension
            array_shift($parts); // Remove filename
            foreach ($parts as $part) {
                if (in_array(strtolower($part), $this->dangerousExtensions)) {
                    return [
                        'safe' => false,
                        'reason' => 'File contains suspicious double extension'
                    ];
                }
            }
        }
        return ['safe' => true, 'reason' => ''];
    }

    protected function checkMimeType(UploadedFile $file, string $type): array
    {
        $mime = $file->getMimeType();
        $allowedMimes = $type === 'document' ? $this->allowedDocumentMimes : $this->allowedImageMimes;

        if (!in_array($mime, $allowedMimes)) {
            return [
                'safe' => false,
                'reason' => "File MIME type '{$mime}' is not allowed for {$type} uploads"
            ];
        }
        return ['safe' => true, 'reason' => ''];
    }

    protected function checkFileContent(UploadedFile $file): array
    {
        $mime = $file->getMimeType();
        $isImage = str_starts_with($mime, 'image/');

        // Read first 8KB to check for dangerous patterns
        $handle = fopen($file->getRealPath(), 'r');
        $content = fread($handle, 8192);
        fclose($handle);

        // For text-based dangerous signatures, only check in non-image contexts
        // or check if they appear at the very start of the file (not randomly in binary data)
        $textSignatures = ['<?php', '<?=', '<script', '#!/'];
        $binarySignatures = ['MZ']; // Windows executable

        foreach ($textSignatures as $signature) {
            if ($isImage) {
                // For images, only flag if the signature is at the very beginning
                if (stripos($content, $signature) === 0) {
                    return [
                        'safe' => false,
                        'reason' => 'File contains suspicious content that may indicate it is malicious'
                    ];
                }
            } else {
                if (stripos($content, $signature) !== false) {
                    return [
                        'safe' => false,
                        'reason' => 'File contains suspicious content that may indicate it is malicious'
                    ];
                }
            }
        }

        // MZ (Windows executable) - only dangerous at position 0
        foreach ($binarySignatures as $signature) {
            if (strpos($content, $signature) === 0) {
                return [
                    'safe' => false,
                    'reason' => 'File contains suspicious content that may indicate it is malicious'
                ];
            }
        }

        // Check for null bytes - skip for binary files (images, PDFs) as they naturally contain null bytes
        if (!$isImage && !in_array($mime, ['application/pdf'])) {
            if (strpos($content, "\0") !== false) {
                return [
                    'safe' => false,
                    'reason' => 'File contains suspicious null bytes'
                ];
            }
        }

        return ['safe' => true, 'reason' => ''];
    }

    protected function checkMimeExtensionConsistency(UploadedFile $file): array
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = $file->getMimeType();

        $validCombinations = [
            'jpg' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png' => ['image/png'],
            'gif' => ['image/gif'],
            'webp' => ['image/webp'],
            'pdf' => ['application/pdf'],
        ];

        if (isset($validCombinations[$extension])) {
            if (!in_array($mime, $validCombinations[$extension])) {
                return [
                    'safe' => false,
                    'reason' => "File extension '.{$extension}' does not match its actual content type '{$mime}'"
                ];
            }
        }

        return ['safe' => true, 'reason' => ''];
    }

    /**
     * Set max file size in MB
     */
    public function setMaxSize(int $megabytes): self
    {
        $this->maxFileSize = $megabytes * 1048576;
        return $this;
    }
}
