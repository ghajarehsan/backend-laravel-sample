<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function newBrand()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'title' => 'required|string|max:100',
                'title_en' => 'required|string|max:100'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $productBrand = ProductBrand::create([
                'title' => $this->request->title,
                'title_en' => $this->request->title_en,
                'creator_id' => auth()->user()->id
            ]);

            DB::commit();

            return response()->json([
                'data' => [
                    'productBrand' => $productBrand
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'brand was created successfully'
                ]
            ], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'status' => 400,
                    'messages' => $messages
                ]
            ], 200);
        }

    }

}
