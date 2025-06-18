<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student HOme</title>
</head>
<body>
    Student Home
    {{Auth::guard('student')->user()->firstname}}
    <br>
    <a href="{{route('Student.logout')}}" onclick="event.preventDefualt(); document.getElementById('logout-form').submit();"> Logout</a>
    <form action="{{route('Student.logout')}}" method="POST" id="logout-form" class="d-none"> @csrf </form>
</body>
</html>