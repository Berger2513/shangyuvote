<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-cn" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-cn">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>上虞上城公安系统</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="{{ asset('asset_admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('asset_admin/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/theme/default.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="http://res.wx.qq.com/open/libs/weui/0.4.0/weui.min.css">
    <link href="{{ asset('asset_admin/css/weiui.css') }}" rel="stylesheet" />
    <script src="{{ asset('asset_admin/assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
    @yield('admin-css')
    <!-- ================== END BASE JS ================== -->
</head>
<body ontouchstart>

    @yield('content')


<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('asset_admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
<script src="{{ asset('asset_admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
<script src="{{ asset('asset_admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('asset_admin/assets/crossbrowserjs/html5shiv.js') }}"></script>
<script src="{{ asset('asset_admin/assets/crossbrowserjs/respond.min.js') }}"></script>
<script src="{{ asset('asset_admin/assets/crossbrowserjs/excanvas.min.js') }}"></script>
<![endif]-->

@yield('js')
<!-- ================== END PAGE LEVEL JS ================== -->


</body>
</html>
