@extends('Guest.layout')
@section('title', 'Create Company')
    
@section('content')


  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <center>
        <br>
        <img src="{{asset( 'images/WorkplaceIcon.png' )}}" alt="Company Logo" style=" height: 64px; width: auto;" class="companyLogo"/>
        </center>

        <div id="createaccbox">  
        <br><br>
        <center>
          <h5><u><b>Company Registration</b></u></h5><br>
        </center>
        
        <form action="/storeComData" method="POST" enctype="multipart/form-data">
          @csrf
            <label for="companyname" style="font-size:14px";>Company Name:</label><br>
            <input type="text" id="companyname" class="details" name="companyname" value="{{old('companyname')}}">
            <br>
            @error('companyname')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="companyDescription" style="font-size:14px";>About Company:</label><br>
            <input type="text" class="details" name="companyDescription" value="{{old('companyDescription')}}">
            <br>
            @error('companyDescription')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="regnumber" style="font-size:14px";>Company Registration Number:</label><br>
            <input type="text" id="regnumber" class="details" name="regnumber" value="{{old('regnumber')}}">
            <br>
            @error('regnumber')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="email" style="font-size:14px">Email:</label><br>
            <input type="email" id="email" class="details" name="email" value="{{old('email')}}">
            <br>
            @error('email')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="phone" style="font-size: 14px;">Contact Number:</label><br>
            <input type="text" id="phone" class="details" name="phone" value="{{old('phone')}}" >
            <br>
            @error('phone')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="Address" style="font-size:14px";>Address:</label><br>
            <input type="text" class="details" name="Address" value="{{old('Address')}}">
            <br>
            @error('Address')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
           
  
            <label for="profilePicture" style="font-size:14px";>Profile Picture:</label><br>
            <input type="file" name="profilePicture" style="font-size:14px"; value="{{old('profilePicture')}}"><br>
            @error('profilePicture')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="comlinkedin" style="font-size: 14px;">Add Company LinkedIn Profile/Website:</label><br>
            <input type="url" id="linkedin" class="details" name="comlinkedin" style="font-size: 14px;" value="{{old('comlinkedin')}}">
            <br>
            @error('comlinkedin')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br><br>
  
            <label for="username" style="font-size:14px";>Username (for InternHub login):</label><br>
            <input type="text" class="details" name="username">
            <br>
            @error('username')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br>
  
            <label for="password" style="font-size:14px";>Password (for InternHub login):</label><br>
            <input type="text" id="password" class="details" name="password">
            <br>
            @error('password')
              <p class="text-red text-xs mt-1">{{$message}}</p>
            @enderror
            <br><br><br><br>

            <center>
            <input type="submit" value="Submit" id="createacc-subBtn"><br><br>
            <a href="/login"><input type="button" value="Back to Log In" id="createacc-logBtn"></a>
          </center>
             
        </form>
    </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>



    
@endsection