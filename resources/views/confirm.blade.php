<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Mail</title>
</head>
<body>
    <h1>Dear:{{ $data['username'] }}</h1>
    <h2>{{ $data['message'] }}</h2>
</body>
</html>