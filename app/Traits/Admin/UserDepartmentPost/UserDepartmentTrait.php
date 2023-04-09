<?php


namespace App\Traits\Admin\UserDepartmentPost;


use App\Models\UserDepartment;
use App\Models\UserPost;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

trait UserDepartmentTrait
{

    public function newUserDepartment()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'name' => 'required|string|max:100',
                'is_sub_department' => 'required|boolean',
                'parent_id' => 'integer|exists:user_departments,id',
                'posts_id' => 'required|string|max:100'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $userDepartment = UserDepartment::create([
                'name' => $this->request->name,
                'parent_id' => $this->request->is_sub_department == true ? $this->request->parent_id : null,
                'creator_id' => auth()->user()->id
            ]);

            $posts = $this->getPostCollection(explode(',', $this->request->posts_id));

            $userDepartment->user_posts()->sync($posts);

            DB::commit();

            return response()->json([
                'data' => [
                    'department' => $userDepartment
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'user department was created successfully'
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

    public function getAllDepartment($department_id = null)
    {

        try {

            if (Cache::has('userDepartment' . $department_id)) return Cache::get('userDepartment' . $department_id);

            $departments = UserDepartment::with(['user_posts' => function ($query) {
                $query->select('user_posts.id', 'user_posts.name', 'user_posts.value');
            }])
                ->where('parent_id', $department_id)
                ->get(['id', 'name', 'parent_id']);

            foreach ($departments as $key => $row) {
                $row['children'] = $this->getAllDepartment($row->id);
            }

            Cache::put('userDepartment' . $department_id, $departments, 10000);

            return $departments;

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

    private function getPostCollection($posts)
    {
        return UserPost::whereIn('id', $posts)->get();
    }

}
