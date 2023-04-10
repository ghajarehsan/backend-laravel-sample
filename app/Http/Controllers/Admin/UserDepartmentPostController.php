<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Admin\UserDepartmentPost\UserDepartmentTrait;
use App\Traits\Admin\UserDepartmentPost\UserPostTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDepartmentPostController extends Controller
{

    use UserPostTrait, UserDepartmentTrait;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

}
