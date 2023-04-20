<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getUserInformation()
    {
        try {

            $user = auth()->user();

            $permissions = $user->getUserPermission();

            $roles = $user->getUserRole();

            return response()->json([
                'data' => [
                    'permissions' => $permissions,
                    'roles' => $roles,
                    'user' => [
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'email' => $user->email,
                        'username' => $user->username
                    ]
                ],
                'meta' => [
                    'status' => 200
                ]
            ], 200);


        } catch (\Exception $exception) {
            return response()->json([
                'meta' => [
                    'status' => 400,
                    'messages' => $exception->getMessage()
                ]
            ]);
        }
    }

}
