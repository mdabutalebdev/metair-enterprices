<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('image_url')) {
    /**
     * Resolve a stored image path to a usable URL.
     * Falls back to a placeholder when the path is empty.
     */
    function image_url(?string $path, string $placeholderText = 'METAIR+ENTERPRISE'): string
    {
        if (empty($path)) {
            return 'https://placehold.co/600x600/eaf0fa/17346b?text='.urlencode($placeholderText);
        }

        // Absolute URLs pass through untouched.
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Resolve to a real file under public/. Supports both files dropped
        // directly in public/ (e.g. "images/foo.webp") and files served through
        // the storage symlink (e.g. "products/foo.webp" => public/storage/...).
        $rel = ltrim($path, '/');

        foreach ([$rel, 'storage/'.$rel] as $candidate) {
            if (file_exists(public_path($candidate))) {
                // URL-encode each segment (handles spaces, parentheses, Bengali,
                // "+", etc.) while keeping the slashes intact.
                $encoded = implode('/', array_map('rawurlencode', explode('/', $candidate)));

                return '/'.$encoded;
            }
        }

        return 'https://placehold.co/600x600/eaf0fa/17346b?text='.urlencode($placeholderText);
    }
}

if (! function_exists('is_video')) {
    /**
     * Determine whether the given path points to a video file.
     */
    function is_video(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return in_array($ext, ['mp4', 'webm', 'ogg', 'mov'], true);
    }
}

if (! function_exists('bdt')) {
    /**
     * Format a number as a Bangladeshi Taka amount (e.g. "BDT 1,299").
     */
    function bdt($amount): string
    {
        return '৳ '.number_format((float) $amount);
    }
}
