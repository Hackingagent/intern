<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Home</title>
</head>
<body>
    Company Home
    {{Auth::guard('company')->user()->name}}
    <br>
    <a href="{{route('Company.logout')}}" onclick="event.preventDefualt(); document.getElementById('logout-form').submit();"> Logout</a>
    <form action="{{route('Company.logout')}}" method="POST" id="logout-form" class="d-none"> @csrf </form>
</body>
</html>