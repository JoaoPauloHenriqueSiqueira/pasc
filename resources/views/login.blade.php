<!DOCTYPE html>
<html>

<head>
    <title>Login Pasc - LABS</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <br />
    <div class="container box">
        <h3 align="center">Login Pasc - LABS</h3><br />

        @if(isset(Auth::user()->email))
        <script>
            window.location = "/main/successlogin";
        </script>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="contact-wrapper">
            <header class="login-cta">
                <h2>Account Login</h2>
            </header>
            <form method="post" action="{{ url('/main/checklogin') }}">
                <div class="form-row">
                <input type="email" name="email" class="form-control" />
                    <span>Username or Email</span>
                </div>
                <div class="form-row">
                <input type="password" name="password" class="form-control" />
                    <span>Password</span>
                </div>
                <div class="form-row"></div>
                <div class="form-row">
                    <button type="submit">Login to your Account!</button>
                </div>
            </form>
        </div>
        
    </div>
</body>

</html>