<?php


namespace App\Services\UploadFile;


use App\Jobs\RemoveUploadedFileJob;
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

    public function upload($model, $model_id, $is_private = 1, array $resize = null)
    {

        DB::beginTransaction();

        try {

            $validation = $this->uploadValidation($model);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $fileName = $this->uploadPhysically($is_private, $resize, $model);

            $file = $this->fillDatabase($fileName, $model, $model_id, $is_private);

            DB::commit();

            return $file;


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

    private function fillDatabase($fileName, $model, $model_id, $is_private)
    {

        $fileType = $this->getFileType();

        $file = UploadFile::Create([
            'creator_id' => auth()->user()->id,
            'name' => $this->request->name,
            'upload_file_type' => $model,
            'upload_file_id' => $model_id,
            'main_path' => serialize($fileName),
            'path' => $fileName[0],
            'size' => $this->getFileSize(),
            'is_private' => $is_private,
            'mime' => $fileType,
            'extension' => $this->getFileExtension(),
        ]);


        if ($is_private) RemoveUploadedFileJob::dispatch($file)->delay(1800);

        return $file;
    }

    private function uploadValidation($model)
    {

        if (!class_exists($model)) throw new \Exception('مدل دریافتی وجود ندارد');

        $max_file_upload = 6000;

        $validation = Validator::make($this->request->all(), [
            'name' => 'required|string|max:50|min:1',
            'file' => 'required|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,pdf,zip,rar,avi,mpeg,quicktime,mp4,jpeg,jpg,png,tiff,gif|file|max:' . $max_file_upload . '',
        ], [
            'name.required' => 'نام فایل الزامی میباشد',
            'file.mimetypes' => 'نوع فایل نا معتبر میباشد',
            'file.required' => 'فایل الزامی میباشد',
            'file.max' => 'فایل آپلود شده نهایتا میتواند ' . $max_file_upload . ' کیلو بایت باشد',
        ]);

        return $validation;

    }

    private function uploadPhysically($is_private, $resize, $model)
    {

        $name = $this->createName($resize, $is_private, $model);

        $method = $this->getMethod($is_private);

        $mainPath = $this->storage->$method($this->getFileType(), $this->file, $name, $resize);

        return $mainPath;

    }

    private function createName($resize, $is_private, $model)
    {

        $model = explode('\\', $model)[2];

        $resizeName =
            $model .
            '/' .
            date('Y') .
            '/' .
            date('m') .
            '/' .
            date('d') .
            '/' .
            $this->getFileType() .
            '/' . rand() .
            '/' .
            auth()->user()->id .
            '-' .
            date('H-i-s') .
            ',orginal' .
            '.' .
            $this->getFileExtension();


        $normalName =
            $model .
            '/' .
            date('Y') .
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

        return count($resize) > 0 && $is_private == 0 ? $resizeName : $normalName;
    }

    private function getMethod($is_private)
    {
        return $is_private ? 'uploadFileAsPrivate' : 'uploadFileAsPublic';
    }

    private function getFileClientMimeType()
    {
        return $this->file->getClientMimeType();
    }

    public function getFileExtension()
    {
        return $this->file->extension();
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
