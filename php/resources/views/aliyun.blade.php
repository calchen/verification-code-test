<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>阿里云</title>
    <link href="{{ env('URL_PREFIX') }}/asset/css/common.css" rel="stylesheet">
    <style>
        #captcha1 {
            margin: 20px 0 10px 20px;
        }

        .captcha {
            margin: 10px 0 10px 20px;
        }
    </style>
    <link type="text/css" href="//g.alicdn.com/sd/ncpc/nc.css?t={{ time() * 1000 }}" rel="stylesheet"/>
    <script type="text/javascript" charset="utf‐8" src="//g.alicdn.com/sd/ncpc/nc.js?t={{ time() * 1000 }}"></script>
</head>
<body>
<a href="../" class=>返回</a>
<h1>极验</h1>
<hr>
<div id="_umfp" style="display:inline;width:1px;height:1px;overflow:hidden"></div>

<div id="captcha1">
    <div id="dom_id"></div>
</div>

<script src="{{ env('URL_PREFIX') }}/asset/js/jquery-1.12.3.min.js"></script>
<script>
    var nc = new noCaptcha();
    var nc_appkey = 'MAXA';  // 应用标识,不可更改
    var nc_scene = 'common';  //场景,不可更改
    var nc_token = [nc_appkey, (new Date()).getTime(), Math.random()].join(':');
    var nc_option = {
        renderTo: '#dom_id',//渲染到该DOM ID指定的Div位置
        appkey: nc_appkey,
        scene: nc_scene,
        token: nc_token,
//        trans: '{"name1":"code100"}',//测试用，特殊nc_appkey时才生效，正式上线时请务必要删除；code0:通过;code100:点击验证码;code200:图形验证码;code300:恶意请求拦截处理
        callback: function (data) {// 校验成功回调
            alert('前端验证成功');
            alert("即将发起后端验证，理论上在后台执行相关业务逻辑前应该验证，并不需要将这一步展现给用户");
            $.ajax({
                // 获取id，challenge，success（是否启用failback）
                type: "POST",
                url: "{{ env('URL_PREFIX') }}/aliyun/validate",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    scene: nc_scene,
                    token: nc_token,
                    sig: data.sig,
                    csessionid: data.csessionid
                }),
                success: function (data) {
                    alert("后端验证：" + data.message);
                }
            });
        }
    };
    nc.init(nc_option);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(["setDomains", ["*.just4fun.chenky.com"]]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function () {
        var u = "//piwik.chenky.com/";
        _paq.push(['setTrackerUrl', u + 'piwik.php']);
        _paq.push(['setSiteId', '2']);
        var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
        g.type = 'text/javascript';
        g.async = true;
        g.defer = true;
        g.src = u + 'piwik.js';
        s.parentNode.insertBefore(g, s);
    })();
</script>
<noscript><p><img src="//piwik.chenky.com/piwik.php?idsite=2" style="border:0;" alt=""/></p></noscript>
<!-- End Piwik Code -->
</body>
</html>
