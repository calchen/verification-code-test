<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>点触</title>
    <link href="{{ env('URL_PREFIX') }}/asset/css/common.css" rel="stylesheet">
</head>
<body>
<a href="../" class=>返回</a>
<h1>点触</h1>
<hr>
<ul>
    <li><a href="{{ env('URL_PREFIX') }}/touclick/1" target="_blank">方式1 拖动型</a></li>
    <li><a href="{{ env('URL_PREFIX') }}/touclick/2" target="_blank">方式2 拖动型</a></li>
    <li><a href="{{ env('URL_PREFIX') }}/touclick/3" target="_blank">方式3 图标选择型</a></li>
</ul>

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
