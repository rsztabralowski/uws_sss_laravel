<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    /**
     * Handle file upload.
     * @param file to upload
     * @param old file path to remove
     * @return fileNameToStore
     */
    public static function getFileName($file, $oldPath = null)
    {
         // Get filename with the extension
         $filenameWithExt = $file->getClientOriginalName();
         // Get just filename
         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         // Get just ext
         $extension = $file->getClientOriginalExtension();
         // Filename to store
         $fileNameToStore= $filename.'_'.time().'.'.$extension;
         // Upload image
         $path = $file->storeAs('public/facts_images', $fileNameToStore);

        if($oldPath != null)
        {
            // Remove old file
            Storage::delete('public/facts_images/'. $oldPath);
        }
         
         return $fileNameToStore;
    }
}