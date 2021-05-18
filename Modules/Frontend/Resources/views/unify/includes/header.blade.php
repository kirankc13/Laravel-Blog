<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Title -->
  <title>@yield('title')</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets_unify/img/favicon.ico">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="{{asset('assets_unify/vendor/bootstrap/bootstrap.min.css')}}">
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="{{asset('assets_unify/vendor/icon-awesome/css/font-awesome.min.css')}}">

   <!-- CSS Unify -->
   <link rel="stylesheet" href="{{asset('assets_unify/css/unify-core.css')}}">
   <link rel="stylesheet" href="{{asset('assets_unify/css/unify-components.css')}}">
   <link rel="stylesheet" href="{{asset('assets_unify/css/unify-globals.css')}}">

   <!-- CSS Customization -->
   <link rel="stylesheet" href="{{asset('assets_unify/css/custom.css')}}">
   <link rel="stylesheet" href="{{asset('assets_unify/content-styles.css')}}">
    @yield('styles')
</head>
<body class="">
    <main>





