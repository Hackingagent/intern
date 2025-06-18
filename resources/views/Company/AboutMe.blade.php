@extends('Company.layout')

@section('title', 'Edit Post')


@section('content')


<br>
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 addpost">

    <div class="heading"><u>Edit Company Details</u><br><br>
      <img src="{{ asset('storage/'.Auth::guard('company')->user()->profilePic) }}" style="width: 40%; height: auto;"  alt="Comapny Avatar" id="CompanyAvatar">
    </div>
    
    <form action="{{route('Company.editComData')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <br>
        <label for="companyname" class="addpostlabel">Company Name:</label><br>
        <input type="text" id="companyname" class="details" name="companyname" value="{{$user->name}}">
        <br>
        @error('companyname')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="companyDescription" class="addpostlabel">About Company:</label><br>
        <input type="text" class="details" name="companyDescription" value="{{$user->companyDescription}}">
        <br>
        @error('companyDescription')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="regnumber" class="addpostlabel">Company Registration Number:</label><br>
        <input type="text" id="regnumber" class="details" name="regnumber" value="{{$user->regNumber}}">
        <br>
        @error('regnumber')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="email" class="addpostlabel">Email:</label><br>
        <input type="email" id="email" class="details" name="email" value="{{$user->email}}">
        <br>
        @error('email')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="phone" class="addpostlabel">Contact Number:</label><br>
        <input type="text" id="phone" class="details" name="phone" value="{{$user->tel}}" >
        <br>
        @error('phone')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="Address" class="addpostlabel">Address:</label><br>
        <input type="text" class="details" name="Address" value="{{$user->address}}">
        <br>
        @error('Address')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

       

        <label for="profilePicture" class="addpostlabel">New Profile Picture:</label><br>
        <input type="file" name="profilePicture" class="addpostlabel" ><br>
        @error('profilePicture')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br>

        <label for="comlinkedin" class="addpostlabel">Add Company LinkedIn Profile/Website:</label><br>
        <input type="url" id="linkedin" class="details" name="comlinkedin" style="font-size: 14px;" value="{{$user->linkedin}}">
        <br>
        @error('comlinkedin')
          <p class="input-error">{{$message}}</p>
        @enderror
        <br><br>
      <div style="text-align: center">
        <input type="submit" value="Submit" class="subBtn">
      </div>
         
    </form>
    <br><br>
    <div style="text-align: center">
    <a href="{{route('Company.deletemyaccount')}}"><Button class="btn btn-danger" id="deletemyaccountbtn" onclick="return confirm('{{ __('Are you sure you want to delete your account? You cannot undo this!') }}')">Delete My Account</Button></a>
    </div>


  </div>
  <div class="col-lg-2"></div>
</div>
        

@endsection