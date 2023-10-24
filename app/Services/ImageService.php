<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function isImageUrlValid($url): bool
    {
        $response = Http::head($url);
        return $response->successful() && in_array(
                $response->header('Content-Type'), ['image/jpeg', 'image/png', 'image/gif']
            );
    }

    public function downloadAndSaveImage($url): string
    {
        $contents = file_get_contents($url);
        $filename = 'articles/' . basename($url);
        Storage::disk('public')->put($filename, $contents);
        return $filename;
    }
}

