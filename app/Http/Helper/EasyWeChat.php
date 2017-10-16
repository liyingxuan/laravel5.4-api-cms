<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/7/18
 * Time: 下午5:45
 */

namespace App\Http\Helper;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use Illuminate\Support\Facades\Log;

/**
 * API文档：https://easywechat.org/zh-cn/docs/
 *
 * Class EasyWeChat
 * @package App\Http\Helper
 */
class EasyWeChat
{
    /**
     * 获取基础参数
     *
     * @return array
     */
    public static function getOptions()
    {
        return [
            'debug' => true,

            'app_id' => env('WECHAT_APPID'), // AppID
            'secret' => env('WECHAT_SECRET'), // AppSecret
            'token' => env('WECHAT_TOKEN') // Token
            // 'aes_key' => null, // 可选

//    'log' => [
//        'level' => 'debug',
//        'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
//    ],
            //...
        ];
    }

    /**
     * 获取微信支付参数
     *
     * @return array
     */
    public static function getPayOptions()
    {
        return [
            'debug' => true,

            'app_id' => env('WECHAT_APPID'), // AppID
            'secret' => env('WECHAT_SECRET'), // AppSecret
            'token' => env('WECHAT_TOKEN'), // Token

            /**
             * payment
             */
            'payment' => [
                'merchant_id' => env('WECHAT_MCH_ID'),
                'key' => env('WECHAT_API_KEY'),
                'cert_path' => env('WECHAT_CERT_PATH'),
                'key_path' => env('WECHAT_KEY_PATH'),
                'notify_url' => env('WECHAT_NOTIFY_URL'), // 你也可以在下单时单独设置来想覆盖它
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];
    }

    /**
     * 回应微信服务器，给予响应
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function getResponse()
    {
        $options = self::getOptions();
        $app = new Application($options);

        return $app->server->serve();
    }

    /**
     * 设置自定义菜单
     *
     * @param $buttons
     */
    public static function setMenus($buttons)
    {
        $options = self::getOptions();
        $app = new Application($options);
        $menu = $app->menu;
        $menu->add($buttons);
    }

    /**
     * 获取所有关注用户
     *
     * @return \EasyWeChat\Support\Collection
     */
    public static function getAllFans()
    {
        $options = self::getOptions();

        $app = new Application($options);
        $userService = $app->user;

        $userInfo = $userService->lists();
        $users = $userService->batchGet($userInfo->data['openid']);
        $users = $users->user_info_list;

        $usersStr = json_encode($users);
        $usersArr = json_decode($usersStr, true);

        return $usersArr;
    }

    /**
     * 新建订单
     */
    public static function newOrder()
    {
        $app = new Application(self::getPayOptions());
        $payment = $app->payment;

        $attributes = [
            'trade_type' => 'JSAPI', // JSAPI，NATIVE，APP...
            'body' => 'iPad mini 16G 白色',
            'detail' => 'iPad mini 16G 白色',
            'out_trade_no' => '1217752501201407033233368018',
            'total_fee' => 5388, // 单位：分
//            'notify_url' => 'http://xxx.com/order-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid' => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];

        $order = new Order($attributes);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
        }
    }

    /**
     * 新建扫码订单
     *
     * @param $body
     * @param $detail
     * @param $tradeNo
     * @param $totalFee
     * @param $openId
     * @param $productId
     * @return bool|mixed
     */
    public static function newNativeOrder($body, $detail, $tradeNo, $totalFee, $openId, $productId)
    {
        $app = new Application(self::getPayOptions());
        $payment = $app->payment;

        $attributes = [
            'trade_type' => 'NATIVE',
            'body' => $body,
            'detail' => $detail,
            'out_trade_no' => $tradeNo,
            'total_fee' => $totalFee, // 单位：分
            'openid' => $openId, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            'product_id' => $productId
        ];

        $order = new Order($attributes);
//        Log::info('newNativeOrder', ['order' => json_encode($order)]);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            return $result->prepay_id;
        } else {
            return false;
        }
    }
}
