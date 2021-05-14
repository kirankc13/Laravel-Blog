

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="{{asset('admin/css/separate/pages/login.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">
    <style>
            .sign-box .sign-avatar img {
                display: block;
                width: 100%;
                -webkit-border-radius: 50%;
                border-radius: 0%;
            }
    </style>
</head>
<body>
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="sign-avatar">
                        <img src="{{asset('admin/img/padlock.png')}}" alt="User Placeholder Image">
                    </div>
                    <header class="sign-title">Enter Email</header>
                    @include('admin.components.messages')
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <button type="submit" class="btn btn-rounded">{{ __('Send Password Reset Link') }}</button>
                </form>
            </div>
        </div>
    </div>
<script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/lib/tether/tether.min.js')}}"></script>
<script src="{{asset('admin/js/lib/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });
            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="{{asset('admin/js/app.js')}}"></script>
</body>
</html>
