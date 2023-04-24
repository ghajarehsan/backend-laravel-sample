<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }



}
