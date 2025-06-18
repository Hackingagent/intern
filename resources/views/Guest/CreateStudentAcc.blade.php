@extends('Guest.layout')
@section('title', 'Create Student')
@section('content')
    
<br>
<center>
<img src="{{asset( 'images/WorkplaceIcon.png' )}}" alt="Company Logo" style=" height: 64px; width: auto;" class="companyLogo"/>
</center>

  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div id="createaccbox"> 
          <center>
          <br><h5><u><b>Student Registration</b></u></h5><br>
        </center> 
        <form action="/storeStuData" method="POST" enctype="multipart/form-data">
          @csrf
            <label for="firstname" style="font-size:14px";>First Name:</label><br>
            <input type="text" id="firstname" class="details" name="firstname" value="{{old('firstname')}}">
            <br>
            @error('firstname')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="lastname" style="font-size:14px";>Last Name:</label><br>
            <input type="text" id="lastname" class="details" name="lastname" value="{{old('lastname')}}">
            <br>
            @error('lastname')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="address" style="font-size:14px";>Address:</label><br>
            <input type="text" id="address" class="details" name="address" value="{{old('address')}}">
            <br>
            @error('address')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="email" style="font-size:14px">Enter Your email:</label><br>
            <input type="email" id="email" class="details" name="email" value="{{old('email')}}">
            <br>
            @error('email')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="contact" style="font-size: 14px;">Contact Number:</label><br>
            <input type="text" id="phone" class="details" name="phone" value="{{old('phone')}}" >
            <br>
            @error('phone')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="profilePicture" style="font-size:14px";>Profile Picture:</label><br>
            <input type="file" name="profilePicture" style="font-size:14px";><br>
            @error('profilePicture')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="university" style="font-size:14px";>University/ Universities:</label><br>
            <input type="text" class="details"  name="university" value="{{old('university')}}">
            <br>
            @error('university')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="degree" style="font-size:14px";>Degree/s:</label><br>
            <input type="text" class="details" name="degree" value="{{old('degree')}}">
            <br>
            @error('degree')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="linkedIn" style="font-size: 14px;">Add your LinkedIn/Github Profile:</label><br>
            <input type="url" id="linkedin" class="details" name="linkedIn" style="font-size: 14px;" value="{{old('linkedIn')}}">
            <br>
            @error('linkedIn')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br><br>
  
            <label for="username" style="font-size:14px";>Username (for Wokrplace login):</label><br>
            <input type="text" class="details" name="username" value="{{old('username')}}">
            <br>
            @error('username')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="password" style="font-size:14px";>Password (for Workplace login):</label><br>
            <input type="text" id="password" class="details" name="password">
            <br>
            @error('password')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <br><br>

            <center>
            <input type="submit" value="Submit" id="createacc-subBtn"><br><br>
            <a href="/login"><input type="button" value="Back to Log In" id="createacc-logBtn"></a>
          </center> <br><br>
        </form>
    </div>

      </div>
      <div class="col-md-2"></div>
    </div>
  </div>


@endsection
    