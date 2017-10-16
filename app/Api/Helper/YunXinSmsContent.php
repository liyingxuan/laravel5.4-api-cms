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
class YunXinSmsContent
{
    /**
     * 发送短信给新的注册用户
     *
     * @param $phone
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendSMS_newUser($phone)
    {
        $ret = self::sendVerifyCode($phone, 'send-sms-new-user');

        if ($ret['code'] == 200) {
            $verifyCode = $ret['obj'];

            User::where('phone', $phone)->update([
                'verify_code' => $verifyCode,
                'password' => bcrypt($verifyCode),
            ]);

//            return response()->json(['debug' => $verifyCode], 200); //验证码自动填写
            return response()->json(['debug' => ''], 200);
        } else {
            return response()->json(['message' => '短信发送失败', 'debug' => $ret], 500);
        }
    }

    /**
     * 发送短信验证码并记录日志
     *
     * @param $phone
     * @param string $logName
     * @return array|bool
     */
    public static function sendVerifyCode($phone, $logName = '验证码')
    {
        /**
         * 网易云信的APP配置信息：
         * https://app.netease.im/index#/
         */
        $AppKey = '';
        $AppSecret = '';

        /**
         * 模板号：需要在网易云信上申请和配置
         */
        $templateId = '';

        /**
         * 调用发送实例：
         */
        $sms = new YunXinSMS($AppKey, $AppSecret);
        $result = $sms->sendSmsCode($templateId, $phone);

        /**
         * 返回结果和记录：
         */
        if ($result['code'] != 200) {
            Log::info($logName, ['context' => json_encode($result)]);
        }

        return $result;
    }
}
