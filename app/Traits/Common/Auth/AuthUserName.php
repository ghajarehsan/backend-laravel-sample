<?php


namespace App\Traits\Common\Auth;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait AuthUserName
{

    public function signIn()
    {

        try {

            $validation = Validator::make($this->request->all(), [
                'username' => 'required|string|max:100',
                'password' => 'required|string|max:100'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::where('username', $this->request->username)->first();

            if (!$user) throw new \Exception('نام کاربری یا رمز عبور معتبر نمیباشد');

            $attempt = Hash::check($user->password, $this->request->password);

            if (!$attempt) throw new \Exception('نام کاربری یا رمز عبور معتبر نمیباشد');

            $token = $this->createToken($user);

            return response()->json([
                'data' => [
                    'token' => $token
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'token was created successfully'
                ]
            ], 200);

        } catch (\Exception $exception) {

            $messages = '';

            if ($exception->getCode() == 400) {
                $messages = unserialize($exception->getMessage());
            } else $messages = $exception->getMessage();

            return response()->json([
                'meta' => [
                    'status' => 400,
                    'messages' => $messages
                ]
            ], 200);

        }

    }


}
