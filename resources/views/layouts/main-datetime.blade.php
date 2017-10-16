<?php
/**
 * Created by PhpStorm.
 * User: mvp_xuan
 * Date: 2016-4-4
 * Time: 19:22
 */
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{ $page_title or "AdminLTE Dashboard" }}</title>
    <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" >
    @yield('style')
</head>
<body class="skin-blue">
<div class="wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{--{{ $page_title or "Page Title" }}--}}
                <small>{{ $page_description or null }}</small>
            </h1>
            <ol class="breadcrumb">
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
                <li><i class="fa fa-home"></i> {{ $page_level or " Level" }}</li>
                <li class="active">{{ $page_title or "Here" }}</li>
            </ol>
        </section>
        <section class="content">
            @include('layouts.message.error')

            @yield('content')
        </section>
    </div>
    @include('layouts.footer')
</div>
<script src="{{ asset ("/assets/js/app.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/assets/js/bootstrap-datetimepicker.js") }}" type="text/javascript"></script>
@yield('script')
</body>
</html>
