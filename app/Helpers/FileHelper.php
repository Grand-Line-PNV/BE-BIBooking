<?php

namespace App\Helpers;

use App\Models\File;
use Illuminate\Support\Str;
use Storage;

class FileHelper
{
    /**
     * Upload general files
     */
    public static function uploadFileToS3($file, $filePath)
    {
        try {
            $fileExtension = $file->extension();
            $fileName = Str::uuid() . '.' . $fileExtension;
            $path = $filePath . "/" . $fileName;
            Storage::disk('s3')->put($path, file_get_contents($file));
            $s3FileUrl = Storage::cloud('s3')->url($path);

            return File::create([
                'name' => $fileName,
                'file_type' => $fileExtension,
                'url' => $s3FileUrl,
                'path' => $filePath,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return false;
        }
    }

    /**
     * Remove a specific file on AWS S3 Bucket
     *
     * @param \App\Models\File $file
     *
     * @return Boolean
     */
    public static function removeFileFromS3($file) {
        try {
            Storage::disk('s3')->delete(self::getFilePath($file));

            return true;
        } catch (\Throwable $e) {

            return false;
        }
    }

    /**
     * Get file path
     */
    private static function getFilePath(File $file)
    {
        return $file->path . '/' . $file->name;
    }
}