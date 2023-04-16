<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\UploadFile;
use App\Models\User;
use App\Services\UploadFile\Uploader;
use Illuminate\Http\Request;


class UploadFileController extends Controller
{

    private $request;
    private $uploader;

    public function __construct(Request $request, Uploader $uploader)
    {
        $this->request = $request;
        $this->uploader = $uploader;
    }

    public function uploadFile()
    {

        try {

//            dd(unserialize('a:3:{i:0;s:63:"storage/User/2023/04/16/image/1239656207/1-06-43-22,orginal.png";i:1;s:63:"storage/User/2023/04/16/image/1239656207/1-06-43-22,100x200.png";i:2;s:63:"storage/User/2023/04/16/image/1239656207/1-06-43-22,400x600.png";}'));

            $resize = [
                [
                    'width' => 100,
                    'height' => 200
                ],
                [
                    'width' => 400,
                    'height' => 600
                ]
            ];

            return $this->uploader->getFilePaths([1,2]);
            return $this->uploader->upload(User::class, auth()->user()->id, 0, $resize);

        } catch (\Exception $exception) {

        }

    }

}
