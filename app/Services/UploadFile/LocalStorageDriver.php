<?php


namespace App\Services\UploadFile;


use Illuminate\Support\Facades\Storage as StorageDriver;
use Intervention\Image\Facades\Image;

class LocalStorageDriver implements UploadFileInterface
{

    public $mainPath = [];

    public function uploadFileAsPrivate($type, $file, $name, $resize)
    {

        $image = StorageDriver::disk('private')->putFileAs('', $file, $name);

        array_push($this->mainPath, 'private/'.$image);

        return $this->mainPath;

    }

    public function uploadFileAsPublic($type, $file, $name, $resize)
    {
        if (count($resize) > 0 && $type != 'image') throw new \Exception('فقط تصویر قابلیت تغییر سایز دارد');

        $image = StorageDriver::disk('public')->putFileAs('', $file, $name);

        array_push($this->mainPath, 'storage/'.$image);

        if (count($resize) > 0) $this->resizeImage($file, $name, $resize, $type);

        return $this->mainPath;

    }

    public function resizeImage($file, $name, $resize, $type)
    {

        $explodePath = explode(',', $name);

        foreach ($resize as $keySize => $rowSize) {
            $path = $image = Image::make($file)
                ->resize($rowSize['width'], $rowSize['height'])
                ->save('storage/' . $explodePath[0] . ',' . $rowSize['width'] . 'x' . $rowSize['height'] . '.' . $file->extension());
            array_push($this->mainPath, $path->dirname.'/'.$path->basename);
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
