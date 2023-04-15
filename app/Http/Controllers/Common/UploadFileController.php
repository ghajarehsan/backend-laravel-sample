<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
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

            $resize = [
                [
                    'width'=>100,
                    'height'=>200
                ],
                [
                    'width'=>400,
                    'height'=>600
                ]
            ];

            return $this->uploader->upload(User::class, auth()->user()->id, 0, $resize);

        } catch (\Exception $exception) {

        }

    }

}
