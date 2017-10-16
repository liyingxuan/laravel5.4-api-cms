<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/8/17
 * Time: 下午4:49
 */
namespace App\Api\Helper;

class Sms
{
    //创蓝发送短信接口URL, 如无必要，该参数可不用修改
    private $api_send_url = 'http://222.73.117.158/msg/HttpBatchSendSM';
    //创蓝短信余额查询接口URL, 如无必要，该参数可不用修改
    private $api_balance_query_url = 'http://222.73.117.158/msg/QueryBalance';
    //创蓝账号
    private $api_account = '';
    //创蓝密码
    private $api_password = '';

    /**
     * 发送短信
     *
     * @param $mobile //手机号码
     * @param $msg //短信内容
     * @param string $needStatus 是否需要状态报告
     * @param string $product 产品id，可选
     * @param string $extno 扩展码，可选
     * @return mixed
     */
    public function sendSMS($mobile, $msg, $needStatus = 'false', $product = '', $extno = '')
    {
        //创蓝接口参数
        $postArr = array(
            'account' => $this->api_account,
            'pswd' => $this->api_password,
            'msg' => $msg,
            'mobile' => $mobile,
            'needstatus' => $needStatus,
            'product' => $product,
            'extno' => $extno
        );

        return $this->curlPost($this->api_send_url, $postArr);
    }

    /**
     * 查询额度/查询地址
     */
    public function queryBalance()
    {
        //查询参数
        $postArr = array(
            'account' => $this->api_account,
            'pswd' => $this->api_password,
        );

        return $this->curlPost($this->api_balance_query_url, $postArr);
    }

    /**
     * 处理返回值
     */
    public function execResult($result)
    {
        return preg_split("/[,\r\n]/", $result);
    }

    /**
     * 通过CURL发送HTTP请求
     *
     * @param string $url //请求URL
     * @param array $postFields //请求参数
     * @return mixed
     */
    private function curlPost($url, $postFields)
    {
        $postFields = http_build_query($postFields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * 魔术获取
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * 魔术设置
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}
