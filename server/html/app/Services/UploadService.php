<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    /**
     * @param UploadedFile $file
     * @param string $folder
     * @return bool|string
     */
    public function upload(UploadedFile $file, $folder = 'todoLists')
    {
        $ext = $file->getClientOriginalExtension();
        do {
            $filename = md5(time() . rand(1, 10000)) . '.' . $ext;
            $path     = $folder . '/' . $filename;
        } while (Storage::exists($path));

        if (!Storage::putFileAs($folder, $file, $filename)) {
            return false;
        }

        return Storage::url($path);
    }
}
