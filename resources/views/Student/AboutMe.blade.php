@extends('Student.layout')

@section('title', 'About Me')


@section('content')


<br>
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 addpost">

    <div class="heading"><u>Edit Your Details</u><br><br>
      <img src="{{ asset('storage/'.Auth::guard('student')->user()->profilePic) }}" style="width: 40%; height: auto;"  alt="Student Avatar" id="CompanyAvatar">
    </div>
    
    <form action="{{route('Student.editStuData')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="firstname" style="font-size:14px";>First Name:</label><br>
        <input type="text" id="firstname" class="details" name="firstname" value="{{$user->firstname}}">
        <br>
        @error('firstname')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="lastname" style="font-size:14px";>Last Name:</label><br>
        <input type="text" id="lastname" class="details" name="lastname" value="{{$user->lastname}}">
        <br>
        @error('lastname')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="address" style="font-size:14px";>Address:</label><br>
        <input type="text" id="address" class="details" name="address" value="{{$user->address}}">
        <br>
        @error('address')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="email" style="font-size:14px">Enter Your email:</label><br>
        <input type="email" id="email" class="details" name="email" value="{{$user->email}}">
        <br>
        @error('email')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="contact" style="font-size: 14px;">Contact Number:</label><br>
        <input type="text" id="phone" class="details" name="phone" value="{{$user->tel}}" >
        <br>
        @error('phone')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="profilePicture" style="font-size:14px";>New Profile Picture:</label><br>
        <input type="file" name="profilePicture" style="font-size:14px";><br>
        @error('profilePicture')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="university" style="font-size:14px";>University/ Universities:</label><br>
        <input type="text" class="details"  name="university" value="{{$user->university}}">
        <br>
        @error('university')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="degree" style="font-size:14px";>Degree/s:</label><br>
        <input type="text" class="details" name="degree" value="{{$user->degree}}">
        <br>
        @error('degree')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="linkedIn" style="font-size: 14px;">Add your LinkedIn/Github Profile:</label><br>
        <input type="url" id="linkedin" class="details" name="linkedIn" style="font-size: 14px;" value="{{$user->linkedin}}">
        <br>
        @error('linkedIn')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br><br>

      <div style="text-align: center">
        <input type="submit" value="Submit" class="subBtn">
      </div>
         
    </form>
    <br><br>
    <div style="text-align: center">
    <a href="{{route('Student.deletemyaccount')}}"><Button class="btn btn-danger" id="deletemyaccountbtn" onclick="return confirm('{{ __('Are you sure you want to delete your account? You cannot undo this!') }}')">Delete My Account</Button></a>
    </div>


  </div>
  <div class="col-lg-2"></div>
</div>
        

@endsection