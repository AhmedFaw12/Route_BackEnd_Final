<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    @include('inc.messages')
    <form action="{{url('/login')}}" method="POST">
        @csrf

        <input type="email" name="email" placeholder = "email">
        <br>

        <input type="password" name="password" placeholder = "password">
        <br>

        <input type="submit" value="login">
    </form>
</body>
</html>
