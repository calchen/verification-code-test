<?php

namespace App\Http\Controllers;

use App\Helper\TouClick;
use App\Helper\TouClickSDK;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TouclickController extends Controller {
    /**
     * 获取测试页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('touclick');
    }

    /**
     * 二次验证
     *
     * @param Request $request
     * @return Response
     */
    public function validateCode(Request $request) {
        $input = $request->input();
        $sid = $input['sid'];
        $checkAddress = $input['checkAddress'];
        $token = $input['token'];
        $type = $input['type'];
        $touclick = new TouClickSDK(env("TOUCLICK_PUBLIC_KEY$type"), env("TOUCLICK_PRIVATE_KEY$type"));
        $res = $touclick->check($sid, $checkAddress, $token);

        return $res;
    }

    public function getPage(Request $request, $type) {
        switch ($type) {
            case 1:
            case 2:
            case 3:
                break;
            default:
                return redirect(env('URL_PREFIX') . '/touclick');
        }
        $data = [
            'publicKey' => env("TOUCLICK_PUBLIC_KEY$type"),
            'privateKey' => env("TOUCLICK_PRIVATE_KEY$type"),
            'type' => $type
        ];
        return view('touclickPage', $data);
    }
}