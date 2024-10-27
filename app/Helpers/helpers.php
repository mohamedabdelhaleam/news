<?php

if (!function_exists('uploadImage')) {
    function uploadImage($request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $fullPath = $request->file($inputName)->store($path, 'public');
            return basename($fullPath);
        }
        return null;
    }
}

if (!function_exists('generateSlug')) {
    function generateSlug($inputName): array|string
    {
        $slug = str_replace(' ', '_', $inputName);

        return $slug;
    }
}
