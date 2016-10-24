<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Helper\AliyunVerificationCode;

class AliyunController extends Controller {
    /**
     * 获取测试页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('aliyun');
    }

    /**
     * 二次验证
     *
     * @param Request $request
     * @return Response
     */
    public function validateCode(Request $request) {
        $input = $request->input();
        $scene = isset($input['scene']) ? $input['scene'] : null;
        $token = isset($input['token']) ? $input['token'] : null;
        $sig = isset($input['sig']) ? $input['sig'] : null;
        $csessionid = isset($input['csessionid']) ? $input['csessionid'] : null;
        // 这里由于我试用了nginx 代理所以要通过 X-Forwarded-For 头信息判断真实IP
        $xForwardedFor = $request->header('X-Forwarded-For');
        if ($xForwardedFor) {
            $ip = explode(',', $xForwardedFor)[0];
        } else {
            $ip = $request->ip();
        }

        $aliyunVerificationCode = new AliyunVerificationCode();
        $verificationResult = $aliyunVerificationCode->check($scene, $token, $sig, $csessionid, $ip);

        $response = new Response();
        $result['message'] = $verificationResult['message'];
        $response->setStatusCode(200);
        $response->setContent($result);
        return $response;
    }
}