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

if (!function_exists('successResponse')) {

    function successResponse($data, $message = "تم تنفيذ العملية بنجاح", $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse($message = "خطاء في تنفيذ العملية", $status = 400)
    {
        $response = [
            'status' => false,
            'message' => $message,
        ];

        return response()->json($response, $status);
    }
}
