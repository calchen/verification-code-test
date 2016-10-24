<?php

namespace App\Helper;

include_once '../ThirdPartSDK/AliyunSaf/aliyun-php-sdk-core/Config.php';
include_once "../ThirdPartSDK/AliyunSaf/aliyun-php-sdk-cf/CF/Request/V20151127/AuthenticateRequest.php";
use CF\Request\V20151127 as CF;

class AliyunVerificationCode {
    // 请替换成阿里云的accesskey
    private $aliyunAk;
    // 请替换成阿里云的secret
    private $aliyunSecret;
    // 应用标识，不可更改
    private $afsAppkey;
    // 应用标识，不可更改
    private $afsAk;

    public function __construct() {
        $this->aliyunAk = env('ALIYUN_ACCESS_KEY_ID');
        $this->aliyunSecret = env('ALIYUN_ACCESS_KEY_SECRET');
        $this->afsAppkey = env('ALIYUN_SAF_APPKEY');
        $this->afsAk = env('ALIYUN_SAF_AK');
    }


    /**
     * 检查验证码是否合法
     *
     * @param $scene
     * @param $token
     * @param $sig
     * @param $csessionid
     * @param $ip
     * @return mixed
     */
    public function check($scene, $token, $sig, $csessionid, $ip) {
        $newRequest = new CF\AuthenticateRequest();

        $afs_serialNo = md5($this->afsAppkey . $this->afsAk . $token . $sig);

        $newRequest->setAppKey($this->afsAppkey);
        $newRequest->setSceneId($scene);
        $newRequest->setSessionId($csessionid);
        $newRequest->setSig($sig);
        $newRequest->setToken($token);
        $newRequest->setRemoteIp($ip);
        $newRequest->setSerno($afs_serialNo);

        $iClientProfile = \DefaultProfile::getProfile("cn-hangzhou", $this->aliyunAk, $this->aliyunSecret);
        $client = new \DefaultAcsClient($iClientProfile);
        $response = $client->doAction($newRequest);
        $code = $response->getStatus();
        $data = json_decode($response->getBody(), true);

        if (200 <= $code && $code < 300 &&
            100 <= $data['SigAuthenticateResult']['Code'] && $data['SigAuthenticateResult']['Code'] < 200) {
            $result = [
                'status' => true,
                'message' => 'ok',
            ];
        } else {
            $result = [
                'status' => false,
                'message' => $data['SigAuthenticateResult']['Msg'],
            ];
        }

        return $result;
    }


}