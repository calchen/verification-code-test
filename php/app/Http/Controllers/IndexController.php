<?php
/**
 * Copyright (C) 2016 上海沃去信息科技有限公司 版权所有。
 *
 * 文件名: IndexController.php
 * 功能描述:
 *
 * 创 建 人: 陈恺垣
 * 创建日期: 2016/09/24 13:39
 *
 */

namespace App\Http\Controllers;


class IndexController extends Controller {
    public function index() {
        return view('welcome');
    }
}