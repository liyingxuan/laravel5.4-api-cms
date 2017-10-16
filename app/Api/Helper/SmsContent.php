<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/8/18
 * Time: 下午5:00
 */
namespace App\Api\Helper;

use App\Models\Api\User;
use Illuminate\Support\Facades\Log;

/**
 * 推送短信文案编辑处
 *
 * Class SmsContent
 * @package App\Api\Helper
 */
class SmsContent
{
    /**
     * 发送短信给新的注册用户
     *
     * @param $phone
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendSMS_newUser($phone)
    {
        $code = rand(100001, 999998);
        $txt = '【聚梦创新】您的验证码是:' . $code; //文案

        $ret = self::sendSms($code, $txt, 'send-sms-new-user');

        if ($ret) {
            User::where('phone', $phone)->update([
                'verify_code' => $code,
                'password' => bcrypt($code),
            ]);

//            return response()->json(['debug' => $code], 200); //验证码自动填写
            return response()->json(['debug' => ''], 200);
        } else {
            return response()->json(['message' => '短信发送失败', 'debug' => $ret], 500);
        }
    }

    /**
     * 发送短信并记录日志
     *
     * @param $phone
     * @param $txt
     * @param $logName
     * @return bool
     */
    public static function sendSms($phone, $txt, $logName)
    {
        $sms = new Sms();
        $result = $sms->sendSMS($phone, $txt);
        $result = $sms->execResult($result);

        if ($result[1] == 0) {
            return true;
        } else {
            Log::info($logName, ['context' => json_encode($result)]);
            return false;
        }
    }
}
