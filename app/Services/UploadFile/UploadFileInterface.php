<?php


namespace App\Services\UploadFile;


interface UploadFileInterface
{

    public function uploadFileAsPrivate($type, $file, $name);

    public function uploadFileAsPublic($type, $file, $name);

    public function download($file);

    public function deleteFile($file);

}
