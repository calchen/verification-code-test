<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>点触</title>
    <link href="{{ env('URL_PREFIX') }}/asset/css/common.css" rel="stylesheet">
    <style>
        #captcha1 {
            margin: 300px 0 10px 20px;
            width: 350px;
        }

    </style>
</head>
<body>
<a href="{{ env('URL_PREFIX') }}/touclick" class=>返回</a>
<h1>点触-方式{{ $type }}</h1>
<hr>
<div id="captcha1"></div>
<input type="hidden" id="type" value="{{ $type }}">
<script src="{{ env('URL_PREFIX') }}/asset/js/jquery-1.12.3.min.js"></script>
<script src="http://js.touclick.com/js.touclick?b={{ $publicKey }}"></script>
<script>
    TouClick.ready(function () {
        /*
         * @param 嵌入点ID
         * @param 配置参数
         */
        TouClick('captcha1', {
            onSuccess: function (obj) {
                alert('前端验证成功');
                console.info(obj);
                $.ajax({
                    // 获取id，challenge，success（是否启用failback）
                    type: "POST",
                    url: "{{ env('URL_PREFIX') }}/touclick/validate",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify({
                        sid: obj.sid,
                        checkAddress: obj.checkAddress,
                        token: obj.token,
                        type: $('#type').val()
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        alert("后端验证结果\ncheckCode：" + data.checkCode + "\ncode：" + data.code + "\nmessage：" + data.message);
                    }
                });
            },
            onFailure: function () {
                alert('前端验证失败');
            },
            onClose: function () {
                console.info('关闭验证码');
            },
            onClick: function () {
                console.info('点击了验证码')
            }
        });
    });
</script>
</body>
</html>
