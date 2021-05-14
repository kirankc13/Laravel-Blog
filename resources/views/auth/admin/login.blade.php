
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
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">            
                <form class="sign-box" method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="sign-avatar">
                        <img src="{{asset('admin/img/avatar-sign.png')}}" alt="User Placeholder Image">
                    </div>
                    <header class="sign-title">Sign In</header>
                    @include('admin.components.messages')
                    <div class="form-group">
                        <input  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail" autofocus/>                        
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password"/>                        
                    </div>
                    <div class="form-group">
                        <div class="checkbox float-left">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                            <label for="remember">Keep me signed in</label>
                        </div>
                        <div class="float-right reset">
                            <a href="{{ route('password.request') }}">Reset Password</a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-rounded">Sign in</button>                    
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