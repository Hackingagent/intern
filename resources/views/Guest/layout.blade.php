<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>@yield('title')</title>
</head>
<body class="login-home">
    <style>
        input {
          font-family: "Open Sans", Arial, sans-serif;
        }
    </style>

@yield('content')

@if (session()->has('message'))
<div x-data="{show:true}" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-success text-white px-48 py-3">
    <p>
        {{session('message')}}
    </p>
</div>
@endif



</body>




</html>