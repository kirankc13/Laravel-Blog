<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="robots" content="none"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{setting('admin-area-website-title')}}</title>
	<link href="{{setting('admin-fav-icon')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="{{setting('admin-fav-icon')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="{{setting('admin-fav-icon')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="{{setting('admin-fav-icon')}}" rel="apple-touch-icon" type="image/png">
	<link href="{{setting('admin-fav-icon')}}" rel="icon" type="image/png">
	<link href="{{setting('admin-fav-icon')}}" rel="shortcut icon">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	@yield('data_table_css')
    <link rel="stylesheet" href="{{asset('admin/css/lib/lobipanel/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/separate/vendor/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/lib/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/separate/pages/widgets.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/separate/vendor/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/lib/bootstrap/bootstrap.min.css')}}">
	@yield('css')
	@if(isset($_COOKIE['dark_mode']))
    <link rel="stylesheet" rel="preload" id="styles" href="{{asset('admin/css/dark-theme.css')}}">
    @else
    <link rel="stylesheet" rel="preload" id="styles" href="{{asset('admin/css/main.css')}}">
    @endif
	<link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">

</head>