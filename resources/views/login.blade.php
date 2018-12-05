<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset("css/login.css") }}" rel="stylesheet">

</head>

<body class="text-center">
<form class="form-signin" method="POST" action="/login">

    <img class="mb-2" src="{{ asset('svg/login.svg') }}" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    {{ csrf_field() }}

</form>
</body>
</html>
