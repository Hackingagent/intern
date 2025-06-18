<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>@yield('title')</title>
</head>

<body style="background-color: #88738E;">
    <div id="popup-message"></div>

    <div class="container p-3" style="background-color: #ffffff;">
        <!-- HEADER DIV -->
			<div class="row header">
				<div class="col-lg-2 col-4">
				<img src="{{ asset ( 'images/WorkplaceIcon.png') }}" alt="Company Logo" style=" width: 100%; height:auto; " class="companyLogo">
				</div>
				<div class="col-lg-8 col-4 ">
				</div>
				<div class="col-lg-2 col-4 ">
                    @auth('student')
                        <a href="{{route('Student.AboutMe')}}" id="NoUnderline"><img src="{{ asset('storage/'.Auth::guard('student')->user()->profilePic) }}" alt="profile pic" style="width: 34px; height: 34px;" class="usericon rounded-pill"><br>{{Auth::guard('student')->user()->firstname}}</a><br>
                        <a href="{{route('Student.logout')}}" onclick="event.preventDefualt(); document.getElementById('logout-form').submit();"> Logout</a>
                        <form action="{{route('Student.logout')}}" method="POST" id="logout-form" class="d-none"> @csrf </form>

                    @endauth

                    @guest
                        <a class="btn btn-secondary" href="{{ route('login') }}">Login</a>
                    @endguest

				</div>
			</div>

        <!-- NavBar -->
        <br>
        @include('partials._stuNavbar')
        <br>

        @yield('content')


        <div class="row">
            <br><br><hr style="color:#242582; height:3px;">

            <p>Copyright @ InternHub </p>
        </div>
</div>
<br>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var message = "{{ session('message') }}";

        if (message) {
            var popup = document.getElementById('popup-message');
            popup.textContent = message;
            popup.style.display = 'block';

            setTimeout(function () {
                popup.style.animation = 'fadeOut 1s';
                popup.style.display = 'none';
            }, 5000); // Show for 5 seconds and then fade out
        }
    });
</script>
</html>