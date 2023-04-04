<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Common\Auth\AuthOtp;
use App\Traits\Common\Auth\AuthUserName;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    use AuthOtp, AuthUserName;

    private $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createToken(User $user)
    {

        $token = $user->createToken('authToken')->plainTextToken;

        return $token;

    }

    public function signOut()
    {

        try {

            $signOut = auth()->user()->currentAccessToken()->delete();

            if (!$signOut) throw new \Exception('در خروج کاربر مشکلی به وجود آمده است لطفا بعدا تلاش کنید');

            return response()->json([
                'data' => [
                    'messages' => 'خروج با موفقیت انجام گردید'
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
