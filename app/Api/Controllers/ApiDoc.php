<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/4/18
 * Time: 下午3:09
 */

namespace App\Api\Controllers;

/**
 * Class HospitalsController
 * @package App\Api\Controllers
 */
class ApiDoc extends BaseController
{
    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $http = env('MY_API_HTTP_HEAD', 'http://localhost');
        $prefix = 'api/';
        $version = 'v1';
        $url = $http . $prefix . $version;

        $api = [
            '统一说明' => [
                '域名' => $http,
                '数据格式' => 'JSON',
                '数据结构(response字段)' => [
                    'code' => '1000',
                    'info' => '状态信息（success | fail）或报错信息；在HTTP状态码非200时,一般是报错信息',
                    'data' => '数据块',
                    'debug' => '只有内测时某些功能有该字段,用于传递一些非公开数据或调试信息'
                ],
                'url字段' => 'HTTP请求地址; {}表示在链接后直接跟该数据的ID值即可,例:http://api-url/v1/data/77?token=xx,能获取id为77的data信息',
                'method字段' => 'GET / POST',
                'form-data字段' => '表单数据',
                'response字段' => '数据结构',
                'HTTP状态码速记' => [
                    '释义' => 'HTTP状态码有五个不同的类别:',
                    '1xx' => '临时/信息响应',
                    '2xx' => '成功; 200表示成功获取正确的数据; 204表示执行/通讯成功,但是无返回数据',
                    '3xx' => '重定向',
                    '4xx' => '客户端/请求错误; 需检查url拼接和参数; 在我们这会出现可以提示的[message]或需要重新登录获取token的[error]',
                    '5xx' => '服务器错误; 可以提示服务器崩溃/很忙啦~',
                ],
            ],

            '无需Token验证' => [
                'API文档' => [
                    'url' => $url . '/doc',
                    'method' => 'GET'
                ],

                '用户' => $this->user_noToken($url)
            ],

            '需要Token验证' => [
                '用户信息' => $this->userInfo($url)
            ]
        ];

        return response()->json(compact('api'));
    }

    /**
     * 无需验证的用户信息
     *
     * @param $url
     * @return array
     */
    public function user_noToken($url)
    {
        return [
            '发送验证码' => [
                '说明' => '未注册会自动注册',
                'url' => $url . '/user/verify-code',
                'method' => 'POST',
                'form-data' => [
                    'phone' => '11位长的纯数字手机号码'
                ],
                'response' => [
                    'debug' => '为了测试方便,成功后会返回随机的4位手机验证码,正式版上线时没有该项'
                ]
            ],

            '登录' => [
                'url' => $url . '/user/login',
                'method' => 'POST',
                'form-data' => [
                    'phone' => '11位长的纯数字手机号码',
                    'password' => '6-60位密码'
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'token' => '成功后会返回登录之后的token值'
                    ]
                ]
            ]
        ];
    }

    /**
     * 用户信息
     *
     * @param $url
     * @return array
     */
    public function userInfo($url)
    {
        return [
            '查询登陆用户自己的信息' => [
                'url' => $url . '/user/me',
                'method' => 'GET',
                'params' => [
                    'token' => ''
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'id' => '用户id',
                        'phone' => '用户注册手机号',
                        'im_token' => 'IM的token',
                        'device_token' => '友盟设备token； IOS：64位长，安卓：44位长',
                        'name' => '用户姓名',
                        'nickname' => '用户昵称',
                        'head_url' => '头像URL',
                        'sex' => '性别'
                    ]
                ]
            ]
        ];
    }
}
