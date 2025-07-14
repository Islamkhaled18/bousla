<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    /**
     * Handle image upload and return the stored path
     *
     * @param Request $request
     * @param string $fieldName
     * @param string $folder
     * @return string|null
     */
    public function handleImageUpload(Request $request, string $fieldName = 'image', string $folder = 'images'): ?string
    {
        if ($request->hasFile($fieldName) && $request->file($fieldName)->isValid()) {
            $image = $request->file($fieldName);
            return $image->store($folder, 'images');
        }

        return null;
    }

    /**
     * Delete old image if exists
     *
     * @param string|null $imagePath
     * @return void
     */
    public function deleteOldImage(?string $imagePath): void
    {
        if ($imagePath) {
            Storage::disk('images')->delete($imagePath);
        }
    }

    /**
     * Handle image update - upload new image and delete old one if needed
     *
     * @param Request $request
     * @param string|null $oldImagePath
     * @param string $fieldName
     * @param string $folder
     * @return string|null
     */
    public function handleImageUpdate(Request $request, ?string $oldImagePath, string $fieldName = 'image', string $folder = 'images'): ?string
    {
        $newImagePath = $this->handleImageUpload($request, $fieldName, $folder);

        if ($newImagePath && $oldImagePath) {
            $this->deleteOldImage($oldImagePath);
        }

        return $newImagePath;
    }
}
