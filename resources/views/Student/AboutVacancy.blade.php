@extends('Student.layout')

@section('title', 'Vacancy Details')

@section('content')
<hr style="color:#242582; height:3px;">

<div class="row" id="myposts">

        <div class="col-lg-1"></div>
        <div class="col-lg-10 feedpostcontent" >
            <div class="heading"><u>Vacancy Details</u></div>

            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" >
                    <img src="{{ asset('storage/'.$vacancy->flyer) }}" style="width: 100%; height: 100%;" alt="postImg">
                </div>
                <div class="col-md-2"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12" >
                    <div class="textdetails">
                        Field : {{$vacancy->jobField}}
                    </div><br>
                    <div class="textdetails">
                        Title/Post : {{$vacancy->jobPost}}
                    </div><br>
                    <div class="textdetails">
                        Salary : {{$vacancy->salary}}
                    </div><br>
                    <div class="textdetails">
                        Location : {{$vacancy->location}}
                    </div><br><br>
                </div>
                <br>

            </div>
            <br>
            <div class="row">

                {{-- <div class="col-4"><a href="/"> <button class="applybtn">Apply</button></a></div> --}}
                @if(\App\Models\StudentApply::where('student_id', Auth::guard('student')->user()->id)->where('post_id', $vacancy->id)->exists())
                    <div class="col-4"><button class="favoritebtn-success">Already Applied</button></div>
                @else
                    <div class="col-4"><a href="{{route('Student.apply.perform', $vacancy->id)}}"><button class="applybtn">Apply</button></a></div>
                @endif


                @if(\App\Models\StudentFavorite::where('student_id', Auth::guard('student')->user()->id)->where('post_id', $vacancy->id)->exists())
                    <div class="col-4"><button class="favoritebtn-success">Already added to favorites</button></div>
                @else
                    <div class="col-4"><a href="{{route('Student.addfavorite', ['vacancy_id' => $vacancy->id])}}"><button class="favoritebtn">Add to favorite</button></a></div>
                @endif


                <div class="col-4"><a href="{{route('Student.StuFeed')}}"><button class="seemore">Back to Feed</button></a></div>

            </div>

        </div>

        <div class="col-lg-1"></div>

</div>

<br><hr style="color:#242582; height:3px;"><br>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 addpost">

      <div class="heading"><u>Company Details</u><br><br>
        <img src="{{ asset('storage/'.$company->profilePic) }}" style="width: 40%; height: auto;"  alt="Comapny Avatar" id="CompanyAvatar">
      </div>

        <br>
          <strong>Company Name:</strong>
          <p>{{$company->name}}</p>
          <br>

          <strong>About Company:</strong>
          <p>{{$company->companyDescription}}</p>
          <br>

          <strong>Company Registration Number:</strong>
          <p>{{$company->regNumber}}</p>
          <br>

          <strong>Company Email:</strong>
          <p>{{$company->email}}</p>
          <br>

          <strong>Contact Number:</strong>
          <p>{{$company->tel}}</p>
          <br>

          <strong>Address:</strong>
          <p>{{$company->address}}</p>
          <br>

          <strong>Company LinkedIn Profile/Website:</strong>
          <p>{{$company->linkedin}}</p>
          <br>

          <center>
            <a href="{{route('Student.StuFeed')}}"><button class="seemore">Back to Feed</button></a>
          </center>



    </div>
    <div class="col-lg-1"></div>
  </div>

<br>

@endsection