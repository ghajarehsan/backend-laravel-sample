<?php


namespace App\Services\UploadFile;


use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Uploader
{

    private $request;
    private $file;
    private $storage;

    public function __construct(Request $request, LocalStorageDriver $storage)
    {
        $this->request = $request;
        $this->storage = $storage;
        $this->file = $this->request->file;
    }

    public function upload($model = null, $model_id = null)
    {

        DB::beginTransaction();

        try {

            $validation = $this->uploadValidation();

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $fileName = $this->uploadPhysically();

            $file = $this->fillDatabase($fileName, $model, $model_id);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'data' => null,
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

    private function fillDatabase($fileName, $model, $model_id)
    {

        $fileType = $this->getFileType();

        $file = UploadFile::Create([
            'creator_id' => auth()->user()->id,
            'upload_file_type'=>'asd',
            'upload_file_id'=>2,
            'name' => $this->request->name,
            'path' => ($this->is_private() ? 'private/' : 'public/') . $fileName,
            'size' => $this->getFileSize(),
            'is_private' => $this->is_private(),
            'mime' => $fileType,
            'extension' => $this->getFileExtension()
        ]);

        switch ($model) {
            case 'session':
            {
                $model = null;
                break;
            }
        }

        if ($model != null) {
            $file->update([
                'fileable_type' => $model,
                'fileable_id' => $model_id
            ]);
        }

//        RemoveUploadedFileJob::dispatch($file)->delay(1800);

        return $file;
    }


    private function uploadValidation()
    {

        $validation = Validator::make($this->request->all(), [
            'name' => 'required|string|max:50|min:1',
            'file' => 'required|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,pdf,zip,rar,avi,mpeg,quicktime,mp4,jpeg,jpg,png,tiff,gif|file|max:100000',
            'is_private' => 'boolean'
        ], [
            'name.required' => 'نام فایل الزامی میباشد',
            'file.mimetypes' => 'نوع فایل نا معتبر میباشد',
            'file.required' => 'فایل الزامی میباشد',
            'file.max' => 'فایل آپلود شده نهایتا میتواند 50 مگ باشد',
            'is_private' => 'نحوه ذخیره فایل یا خصوصی است یا عمومی'
        ]);

        return $validation;

    }

    private function uploadPhysically()
    {

        $name = $this->createName();

        $method = $this->getMethod();

        $this->storage->$method($this->getFileType(), $this->file, $name);

        return $name;

    }

    private function createName()
    {

        return date('Y') .
            '/' .
            date('m') .
            '/' .
            date('d') .
            '/' .
            $this->getFileType() .
            '/' . rand() .
            '-' .
            auth()->user()->id .
            '-' .
            date('H-i-s') .
            '.' .
            $this->getFileExtension();
    }

    private function getMethod()
    {
        return $this->is_private() ? 'uploadFileAsPrivate' : 'uploadFileAsPublic';
    }

    private function getFileClientMimeType()
    {
        return $this->file->getClientMimeType();
    }

    private function getFileExtension()
    {
        return $this->file->extension();
    }

    private function is_private()
    {
        return $this->request->is_private == 1 ? 1 : 0;
    }

    private function getFileType()
    {


        $type = [
            'image/jpg' => 'image',
            'image/tiff' => 'image',
            'image/png' => 'image',
            'image/jpeg' => 'image',
            'image/gif' => 'image',
            'video/avi' => 'video',
            'video/mpeg' => 'video',
            'video/quicktime' => 'video',
            'video/mp4' => 'video',
            'application/zip' => 'zip',
            'application/x-zip-compressed' => 'zip',
            'application/octet-stream' => 'rar',
            'application/pdf' => 'pdf',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'excel',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'word',
        ]
        [$this->getFileClientMimeType()];

        if ($type == null) $type = 'other';

        return $type;

    }

    private function getFileSize()
    {
        return $this->file->getSize();
    }

}
