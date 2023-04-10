<?php


namespace App\Traits\Admin\UserDepartmentPost;


use App\Models\UserPost;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

trait UserPostTrait
{

    public function newUserPost()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'name' => 'required|string|max:100',
                'value' => 'integer|max:150|min:1'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()));

            $post = UserPost::create([
                'name' => $this->request->name,
                'value' => $this->request->has('value') ? $this->request->value : 1,
                'creator_id' => auth()->user()->id
            ]);

            DB::commit();

            $this->cachePosts();

            return response()->json([
                'data' => [
                    'post' => $post
                ],
                'meta' => [
                    'messages' => 'post created successfully',
                    'status' => 200
                ]
            ], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

    public function getAllPost()
    {

        try {

            $posts = Cache::remember('userPosts', 20000, function () {
                return $this->getAllPosts();
            });

            return response()->json([
                'data' => [
                    'posts' => $posts
                ],
                'meta' => [
                    'status' => 200
                ]
            ], 200);

        } catch (\Exception $exception) {
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
        }

        return response()->json([
            'meta' => [
                'status' => 400,
                'messages' => $messages
            ]
        ], 200);

    }

    private function getAllPosts()
    {
        return UserPost::get(['id', 'name', 'value']);
    }

}
