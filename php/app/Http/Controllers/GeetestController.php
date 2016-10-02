<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class GeetestController extends Controller {
    /**
     * 获取测试页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('geetest');
    }

    /**
     * 预处理接口
     *
     * @param Request $request
     * @return Response
     */
    public function getPreProcess(Request $request) {
        $GtSdk = new \GeetestLib(env('GEETEST_CAPTCHA_ID'), env('GEETEST_PRIVATE_KEY'));
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        Session::set('gtserver', $status);
        Session::set('user_id', $user_id);

        $response = new Response();
        $response->setContent($GtSdk->get_response_str());
        return $response;
    }

    /**
     * 二次验证
     *
     * @param Request $request
     * @return Response
     */
    public function validateCode(Request $request) {
        $input = $request->input();

        $GtSdk = new \GeetestLib(env('GEETEST_CAPTCHA_ID'), env('GEETEST_PRIVATE_KEY'));
        $user_id = Session::get('user_id');
        $gtserver = Session::get('gtserver');
        $geetestChallenge = $input['geetestChallenge'];
        $geetestValidate = $input['geetestValidate'];
        $geetestSeccode = $input['geetestSeccode'];

        $response = new Response();
        // 判断是否宕机
        if ($gtserver == 1) {
            $result = $GtSdk->sucess_validate($geetestChallenge, $geetestValidate, $geetestSeccode, $user_id);
            if ($result) {
                $result = [
                    'message' => '成功',
                    'serverStatus' => '正常'
                ];
            } else {
                $result = [
                    'message' => '失败',
                    'serverStatus' => '正常'
                ];
            }
        } else {
            if ($GtSdk->fail_validate($geetestChallenge, $geetestValidate, $geetestSeccode)) {
                $result = [
                    'message' => '成功',
                    'serverStatus' => '宕机'
                ];
            } else {
                $result = [
                    'message' => '失败',
                    'serverStatus' => '宕机'
                ];
            }
        }
        $response->setContent($result);
        return $response;
    }
}