<?php


namespace App\Services\UploadFile;


use Illuminate\Support\Facades\Storage as StorageDriver;
use Intervention\Image\Facades\Image;

class LocalStorageDriver implements UploadFileInterface
{


    public function uploadFileAsPrivate($type, $file, $name, $resize)
    {

        StorageDriver::disk('private')->putFileAs('', $file, $name);

    }

    public function uploadFileAsPublic($type, $file, $name, $resize)
    {
        if (count($resize) > 0 && $type != 'image') throw new \Exception('فقط تصویر قابلیت تغییر سایز دارد');

        StorageDriver::disk('public')->putFileAs('', $file, $name);

        if (count($resize) > 0) $this->resizeImage($file, $name, $resize, $type);

    }

    public function resizeImage($file, $name, $resize, $type)
    {

        $explodePath = explode(',', $name);

        foreach ($resize as $keySize => $rowSize) {
            Image::make($file)
                ->resize($rowSize['width'], $rowSize['height'])
                ->save('storage/' . $explodePath[0] . ',' . $rowSize['width'] . '-' . $rowSize['height'] . '.' . $file->extension());
        }

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
