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

    public function moveFile()
    {

    }

    public function download()
    {

    }

    public function deleteFile()
    {

    }

    public function renameFile()
    {

    }

    public function sizeFile()
    {

    }

}
