 <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>

        {{--<!-- Bootstrap 3.3.7 -->--}}
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/skin-blue.min.css') }}" rel="stylesheet">
        <!-- Ionicons -->
        <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">

    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('css/bootstrap-rtl.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('css/font-awesome-rtl.min.css') }}" rel="stylesheet">
        <!-- Theme style -->
        <link href="{{ asset('css/AdminLTE-rtl.min.css') }}" rel="stylesheet">

        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    @endif

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body class="login-page">

<div class="login-box">

    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div><!-- end of login lgo -->

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
           

            @include('admin/layouts.errors')

            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="@lang('site.email')">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="@lang('site.password')">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group">
                <label style="font-weight: normal;"><input type="checkbox" name="remember"> @lang('site.remember_me')</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('site.login')</button>

        </form><!-- end of form -->

    </div><!-- end of login body -->

</div><!-- end of login-box -->

{{--<!-- jQuery 3 -->--}}
<script src="{{ asset('js/jquery.min.js') }}"></script>

{{--<!-- Bootstrap 3.3.7 -->--}}
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

{{--icheck--}}
<script src="{{ asset('js/icheck.min.js') }}"></script>

{{--<!-- FastClick -->--}}
<script src="{{ asset('js/fastclick.js') }}"></script>

</body>
</html>
