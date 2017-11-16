<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="{{asset('style/admin/layui/css/layui.css')}}" media="all" />
	<link rel="stylesheet" href="{{asset('style/admin/css/font_eolqem241z66flxr.css')}}" media="all" />
	<link rel="stylesheet" href="{{asset('style/admin/css/main.css')}}" media="all" />
	<script type="text/javascript" src="{{asset('style/admin/layui/layui.js')}}"></script>
	@yield('style')
</head>
 @yield('content')

</html>