<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel forum</title>
</head>
<body>
    <h1>Hello Confirm Your Email</h1>
    <a href="{{ url('verify/'.$confirm_code) }}">Click To Confirm</a>
</body>
</html>