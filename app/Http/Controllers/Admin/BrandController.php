<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use App\Services\UploadFile\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{

    private $request;
    private $uploader;

    public function __construct(Request $request, Uploader $uploader)
    {
        $this->request = $request;
        $this->uploader = $uploader;
    }

    public function newProductBrand()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'title' => 'required|string|max:100',
                'title_en' => 'required|string|max:100',
                'files_id' => 'required'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $productBrand = ProductBrand::create([
                'title' => $this->request->title,
                'title_en' => $this->request->title_en,
                'creator_id' => auth()->user()->id,
                'images' => serialize($this->uploader->getFilePaths($this->request->files_id))
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

    public function uploadFileNewProductBrand()
    {
        DB::beginTransaction();

        try {

            $resize = [
                [
                    'width' => 100,
                    'height' => 200
                ]
            ];

            $fileId = $this->uploader->upload(ProductBrand::class, null, 0, $resize)->id;

            DB::commit();

            return response()->json([
                'data' => [
                    'fileId' => $fileId
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'file of brand was uploaded successfully'
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

    public function getAllProductBrand()
    {

        try {

            $brands = Cache::remember('ProductBrand', 10800, function () {
                $brands = ProductBrand::select('id', 'title', 'title_en', 'images', 'created_at')
                    ->get();

                $brandArray = [];

                foreach ($brands as $keyBrand => $rowBrand) {
                    $brandArray[$keyBrand]['id'] = $rowBrand->id;
                    $brandArray[$keyBrand]['title'] = $rowBrand->title;
                    $brandArray[$keyBrand]['title_en'] = $rowBrand->title;
                    $brandArray[$keyBrand]['images'] = unserialize($rowBrand->images);
                    $brandArray[$keyBrand]['created_at'] = $rowBrand->created_at;
                }
                return $brandArray;
            });

            return response()->json([
                'data' => [
                    'allBrands' => $brands
                ],
                'meta' => [
                    'status' => 200
                ]
            ], 200);

        } catch (\Exception $exception) {
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

    public function editProductBrand($productBrandId)
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'title' => 'required|string|max:100',
                'title_en' => 'required|string|max:100',
                'files_id' => 'required'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $productBrand = ProductBrand::find($productBrandId);
            if (!$productBrand) throw new \Exception('آی دی نا معتبر میباشد');
            $productBrand->title = $this->request->title;
            $productBrand->title_en = $this->request->title_en;
            $productBrand->images = serialize($this->uploader->getFilePaths($this->request->files_id));
            $productBrand->save();

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

    public function deleteProductBrand($productBrandId)
    {
        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'title' => 'required|string|max:100',
                'title_en' => 'required|string|max:100',
                'files_id' => 'required'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $productBrand = ProductBrand::find($productBrandId);
            if (!$productBrand) throw new \Exception('آی دی نا معتبر میباشد');
            $productBrand->delete();

            DB::commit();

            return response()->json([
                'meta' => [
                    'status' => 200,
                    'messages' => 'brand was deleted successfully'
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
