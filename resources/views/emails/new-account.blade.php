<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created</title>
</head>
<body>
    <p>
        Hello {{ $user->name }}, <br>
        We have created account for you. Your password is {{ $password }}
    </p>
    <p>
        <a href="{{ route('login') }}">You can log here</a>
    </p>
</body>
</html>
