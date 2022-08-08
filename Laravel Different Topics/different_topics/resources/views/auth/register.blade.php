<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    @include("inc.messages")
    
    <form action="{{url('/register')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder = "name">
        <br>

        <input type="email" name="email" placeholder = "email">
        <br>

        <input type="password" name="password" placeholder = "password">
        <br>

        <input type="password" name="password_confirmation" placeholder = "confirm password">
        <br>

        <input type="submit" value="register">
    </form>
</body>
</html>
