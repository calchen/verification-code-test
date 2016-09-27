<?php
/**
 * Copyright (C) 2016 上海沃去信息科技有限公司 版权所有。
 *
 * 文件名: GeetestController.php
 * 功能描述:
 *
 * 创 建 人: 陈恺垣
 * 创建日期: 2016/09/26 22:35
 *
 */

namespace App\Http\Controllers;


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
     * @return mixed
     */
    public function getPreProcess() {
        $GtSdk = new \GeetestLib(env('GEETEST_CAPTCHA_ID'), env('GEETEST_PRIVATE_KEY'));
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        Session::set('gtserver', $status);
        Session::set('user_id', $user_id);
        return $GtSdk->get_response_str();
    }
}