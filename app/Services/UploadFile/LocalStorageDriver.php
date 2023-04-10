<?php


namespace App\Services\UploadFile;


use Illuminate\Support\Facades\Storage as StorageDriver;

class LocalStorageDriver implements UploadFileInterface
{


    public function uploadFileAsPrivate($type, $file, $name)
    {
        StorageDriver::disk('private')->putFileAs('', $file, $name);
    }

    public function uploadFileAsPublic($type, $file, $name)
    {
        StorageDriver::disk('public')->putFileAs('', $file, $name);
    }

    public function download($file)
    {
        if (!StorageDriver::exists($file->path)) throw new \Exception('فایل مورد نظر موجود نمیباشد');

        return StorageDriver::download($file->path);
    }

    public function deleteFile($file)
    {
        if (!StorageDriver::exists($file->path)) throw new \Exception('فایل مورد نظر موجود نمیباشد');
        return StorageDriver::delete($file->path);
    }

}
