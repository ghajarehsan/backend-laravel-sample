<?php


namespace App\Services\UploadFile;


interface UploadFileInterface
{

    public function uploadFileAsPrivate($type, $file, $name);

    public function uploadFileAsPublic($type, $file, $name);

    public function moveFile();

    public function download();

    public function deleteFile();

    public function renameFile();

    public function sizeFile();



}
