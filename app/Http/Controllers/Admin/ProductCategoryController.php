<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductCategoryFilter;
use App\Models\ProductCategoryFilterOption;
use App\Services\UploadFile\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{

    private $request;
    private $uploader;

    public function __construct(Request $request, Uploader $uploader)
    {
        $this->request = $request;
        $this->uploader = $uploader;
    }

    //category
    public function newProductCategory()
    {
        DB::beginTransaction();
        try {
            $validation = Validator::make($this->request->all(), [
                'order' => 'integer|max:200|min:1',
                'title' => 'required|string|max:200|min:1',
                'title_en' => 'required|string|max:200|min:1',
                'slug' => 'required|string|max:200|min:3',
                'parent_id' => 'required|integer|min:0',
                'files_id' => 'required|array'
            ]);
            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);
            if (!ProductCategory::find($this->request->parent_id) && $this->request->parent_id != 0) throw new \Exception('دسته بندی پدر نامعتبر میباشد');
            $productCategory = ProductCategory::create([
                'order' => $this->request->order,
                'title' => $this->request->title,
                'title_en' => $this->request->title_en,
                'slug' => $this->request->slug,
                'images' => serialize($this->uploader->getFilePaths($this->request->files_id)),
                'parent_id' => $this->request->parent_id,
                'creator_id' => auth()->user()->id
            ]);
            DB::commit();
            return response()->json([
                'data' => [
                    'productCategory' => $productCategory
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategory was created successfully'
                ]
            ]);
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

    public function editProductCategory($productCategoryId)
    {
        DB::beginTransaction();
        try {
            $validation = Validator::make($this->request->all(), [
                'order' => 'integer|max:200|min:1',
                'title' => 'required|string|max:200|min:1',
                'title_en' => 'required|string|max:200|min:1',
                'slug' => 'required|string|max:200|min:3',
                'parent_id' => 'required|integer|min:0',
                'files_id' => 'required|array'
            ]);
            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);
            if (!ProductCategory::find($this->request->parent_id) && $this->request->parent_id != 0) throw new \Exception('دسته بندی پدر نامعتبر میباشد');
            $productCategory = ProductCategory::find($productCategoryId);
            if (!$productCategory) throw new \Exception('دسته بندی محصول نامعتبر میباشد');
            $productCategory->order = $this->request->order;
            $productCategory->title = $this->request->title;
            $productCategory->title_en = $this->request->title_en;
            $productCategory->slug = $this->request->slug;
            $productCategory->images = serialize($this->uploader->getFilePaths($this->request->files_id));
            $productCategory->parent_id = $this->request->parent_id;
            $productCategory->save();
            DB::commit();
            return response()->json([
                'data' => [
                    'productCategory' => $productCategory
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategory was edited successfully'
                ]
            ]);

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

    public function deleteProductCategory($productCategoryId)
    {
        DB::beginTransaction();
        try {
            $productCategory = ProductCategory::find($productCategoryId);
            if (!$productCategory) throw new \Exception('دسته بندی نامعتبر میباشد');
            $subProductCategory = ProductCategory::where('parent_id', $productCategoryId)->get();
            if (count($subProductCategory) > 0) throw new \Exception('این دسته بندی زیر دسته دارد ابتدا باید آن زیر دسته ها حذف یا ویرایش شوند');
            $productCategory->delete();
            DB::commit();
            return response()->json([
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategory was deleted successfully'
                ]
            ]);
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

    public function uploadFileNewProductCategory()
    {
        try {
            $validation = Validator::make($this->request->all(), [
            ]);
            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);
            $resize = [
                [
                    'width' => 100,
                    'height' => 200
                ],
                [
                    'width' => 200,
                    'height' => 300
                ]
            ];
            $fileId = $this->uploader->upload(ProductCategory::class, null, 0, $resize)->id;
            return response()->json([
                'data' => [
                    'fileId' => $fileId
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'file was uploaded successfully'
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

    public function getAllProductCategory($productCategoryId = 0)
    {
        $productCategories = ProductCategory::where('parent_id', $productCategoryId)
            ->select('id', 'order', 'title', 'title_en', 'slug', 'images', 'parent_id', 'created_at')
            ->get();
        foreach ($productCategories as $key => $row) {
            $row['children'] = $this->getAllProductCategory($row->id);
        }
        foreach ($productCategories as $keyProductCategory => $rowProductCategory) {
            $productCategories[$keyProductCategory]['id'] = $rowProductCategory->id;
            $productCategories[$keyProductCategory]['order'] = $rowProductCategory->order;
            $productCategories[$keyProductCategory]['title'] = $rowProductCategory->title;
            $productCategories[$keyProductCategory]['title_en'] = $rowProductCategory->title_en;
            $productCategories[$keyProductCategory]['slug'] = $rowProductCategory->slug;
            $productCategories[$keyProductCategory]['images'] = unserialize($rowProductCategory->images);
            $productCategories[$keyProductCategory]['parent_id'] = $rowProductCategory->parent_id;
            $productCategories[$keyProductCategory]['created_at'] = $rowProductCategory->created_at;
        }
        return $productCategories;
    }

    //categoryFilter
    public function newProductCategoryFilter()
    {
        DB::beginTransaction();
        try {
            $validation = Validator::make($this->request->all(), [
                'product_category_id' => 'required|exists:product_categories,id',
                'type' => 'required|integer|max:1|min:0',
                'name' => 'required|string|max:50|min:1'
            ]);
            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);
            $productCategoryFilter = ProductCategoryFilter::create([
                'type' => $this->request->type,
                'name' => $this->request->name,
                'creator_id' => auth()->user()->id,
                'product_category_id' => $this->request->product_category_id
            ]);
            DB::commit();
            return response()->json([
                'data' => [
                    'productCategoryFilter' => $productCategoryFilter
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategoryFilter was created successfully'
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

    public function editProductCategoryFilter($productCategoryFilterId)
    {
        DB::beginTransaction();
        try {
            $validation = Validator::make($this->request->all(), [
                'product_category_id' => 'required|exists:product_categories,id',
                'type' => 'required|integer|max:1|min:0',
                'name' => 'required|string|max:50|min:1'
            ]);
            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);
            $productCategoryFilter = ProductCategoryFilter::find($productCategoryFilterId);
            if (!$productCategoryFilter) throw new \Exception('آی دی فیلتر دسته بندی معتبر نمیباشد');
            $productCategoryFilter->type = $this->request->type;
            $productCategoryFilter->name = $this->request->name;
            $productCategoryFilter->product_category_id = $this->request->product_category_id;
            $productCategoryFilter->save();
            DB::commit();
            return response()->json([
                'data' => [
                    'productCategoryFilter' => $productCategoryFilter
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategoryFilter was edited successfully'
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

    public function deleteProductCategoryFilter($productCategoryFilterId)
    {
        DB::beginTransaction();
        try {
            $productCategoryFilter = ProductCategoryFilter::find($productCategoryFilterId);
            if (!$productCategoryFilter) throw new \Exception('آی دی فیلتر دسته بندی محصولات نا معتبر میباشد');
            $productCategoryFilter->delete();
            DB::commit();
            return response()->json([
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategoryFilter was deleted successfully'
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

    //categoryFilterOption
    public function newProductCategoryFilterOption()
    {
        DB::beginTransaction();
        try {
            $validation = Validator::make($this->request->all(), [
                'product_category_filter_id' => 'required|exists:product_category_filters,id',
                'type' => 'required|integer|max:1|min:0',
                'name' => 'required|string|max:50|min:1'
            ]);
            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);
            $productCategoryFilterOption = ProductCategoryFilterOption::create([
                'name' => $this->request->name,
                'category_filter_id' => $this->request->product_category_filter_id,
                'creator_id' => auth()->user()->id,
            ]);
            DB::commit();
            return response()->json([
                'data' => [
                    'productCategoryFilterOption' => $productCategoryFilterOption
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategoryFilterOption was created successfully'
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

    public function editProductCategoryFilterOption($productCategoryFilterOptionId){
        DB::beginTransaction();
        try {
            $validation = Validator::make($this->request->all(), [
                'product_category_filter_id' => 'required|exists:product_category_filters,id',
                'name' => 'required|string|max:50|min:1'
            ]);
            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);
            $productCategoryFilterOption = ProductCategoryFilterOption::find($productCategoryFilterOptionId);
            if (!$productCategoryFilterOption) throw new \Exception('آی دی آپشن فیلتر دسته بندی معتبر نمیباشد');
            $productCategoryFilterOption->name = $this->request->name;
            $productCategoryFilterOption->category_filter_id = $this->request->product_category_filter_id;
            $productCategoryFilterOption->save();
            DB::commit();
            return response()->json([
                'data' => [
                    'productCategoryFilter' => $productCategoryFilterOption
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategoryFilterOption was edited successfully'
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

    public function deleteProductCategoryFilterOption($productCategoryFilterOptionId)
    {
        DB::beginTransaction();
        try {
            $productCategoryFilterOption = ProductCategoryFilterOption::find($productCategoryFilterOptionId);
            if (!$productCategoryFilterOption) throw new \Exception('آی دی آپشن فیلتر دسته بندی محصولات نا معتبر میباشد');
            $productCategoryFilterOption->delete();
            DB::commit();
            return response()->json([
                'meta' => [
                    'status' => 200,
                    'messages' => 'productCategoryFilterOption was deleted successfully'
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
