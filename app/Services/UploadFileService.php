<?php

namespace App\Services;

class UploadFileService
{

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getFileName()
    {
         // Get filename with the extension
         $filenameWithExt = $this->file->getClientOriginalName();
         // Get just filename
         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         // Get just ext
         $extension = $this->file->getClientOriginalExtension();
         // Filename to store
         $fileNameToStore= $filename.'_'.time().'.'.$extension;
         //Upload image
         $path = $this->file->storeAs('public/facts_images', $fileNameToStore);
         
         return $fileNameToStore;
    }
}