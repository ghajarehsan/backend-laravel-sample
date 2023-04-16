<?php


namespace App\Services\UploadFile;


interface UploadFileInterface
{

    public function uploadFileAsPrivate($type, $file, $name, $resize);

    public function uploadFileAsPublic($type, $file, $name, $resize);

    public function download($file);

    public function deleteFile($file);

    public function resizeImage($file, $name,$resize,$type);

}
