<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/4/18
 * Time: 下午5:45
 */

namespace App\Api\Controllers;

use App\Api\Helper\SmsContent;
use App\Api\Helper\YunXinSmsContent;
use App\Models\Api\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends BaseController
{
    /**
     * Send verify code.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendVerifyCode(Request $request)
    {
        $phone = $request->get('phone');
        $user = User::where('phone', $phone)->first();
        if (!isset($user->id)) {
            $this->register($phone); //新用户自动注册
        }

//        return YunXinSmsContent::sendVerifyCode($phone); //调用网易云信接口
        return SmsContent::sendSMS_newUser($phone); //调用创蓝接口
    }

    /**
     * User register.
     *
     * @param $phone
     */
    public function register($phone)
    {
        $newUser = [
            'phone' => $phone,
            'register_time' => date('Y:m:d H:i:s')
        ];

        User::create($newUser);
    }

    /**
     * User auth.
     *
     * @param Request $request
     * @return mixed
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['message' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
