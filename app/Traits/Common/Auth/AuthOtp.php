<?php


namespace App\Traits\Common\Auth;


use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

trait AuthOtp
{

    //create otp code and send it to user mobile
    public function sendOtpCode()
    {

        try {

            $validation = Validator::make($this->request->all(), [
                'mobile' => 'required|string|digits_between:10,11|regex:/09[0-9]{9}/',
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->errors()), 400);

            $code = rand(100000, 999999);

           // if (Cache::get('LoginOtp' . $this->request->mobile)) throw new \Exception('باید حداقل 3 دقیقه پس از ارسال کد گذشته باشد');

            Cache::put('LoginOtp' . $this->request->mobile, $code, 180);

            //return $code;

            return response()->json([
                
                'code' => [
                    'code' => $code
                ],
                'data' => [
                    'messages' => 'کد با موفقیت ارسال گردید'
                ],
                'meta' => [
                    'status' => 200
                ]
            ], 200);

        } catch (\Exception $exception) {
            $messages = '';
            if ($exception->getCode() == 400)
                $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();

            return response()->json([
                'meta' => [
                    'status' => 400,
                    'messages' => $messages
                ]
            ], 200);

        }

    }

    //check otp code is correct or not
    public function checkOtpCode()
    {
        try {

            $validation = Validator::make($this->request->all(), [
                'mobile' => 'required|string|digits_between:10,11|regex:/09[0-9]{9}/',
                'code' => 'required|integer|digits_between:6,6'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $code = Cache::get('LoginOtp' . $this->request->mobile);

            if ($code) {
                if ($code != $this->request->code) throw new \Exception('کد وارد شده صحیح نمیباشد');
                else {

                    $user = User::where('mobile', $this->request->mobile)->first();

                    return response()->json([
                        'data' => [
                            'token' => $this->createToken($user)
                        ],
                        'meta' => [
                            'status' => 200,
                        ]
                    ], 200);

                }
            } else throw new \Exception('کد وارد شده منقضی شده است');

        } catch (\Exception $exception) {
            $messages = '';
            if ($exception->getCode() == 400)
                $messages = unserialize($exception->getMessage());
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
