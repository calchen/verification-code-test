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

</body>
</html>
