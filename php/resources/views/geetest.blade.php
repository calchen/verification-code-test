<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>极验</title>
    <link href="/asset/css/common.css" rel="stylesheet">
</head>
<body>
<a href="../" class=>返回</a>
<h1>极验</h1>
<hr>
<div id="captcha"></div>

<script src="/asset/js/jquery-1.12.3.min.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script>

    var handler = function (captchaObj) {
        // 将验证码加到id为captcha的元素里
        captchaObj.appendTo("#captcha");
    };
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        type: "GET",
        url: "/geetest/preProcess?rand=" + Math.round(Math.random() * 100),
        dataType: "json", // 使用jsonp格式
        success: function (data) {
            // 使用initGeetest接口
            // 参数1：配置参数，与创建Geetest实例时接受的参数一致
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "float", // 产品形式
                offline: !data.success
            }, handler);
        }
    });
</script>
</body>
</html>
