@extends('Company.layout')

@section('title', 'Edit Post')


@section('content')

<div class="heading">
    <u>Edit Vacancy Details</u>
</div>
<br>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 addpost">
            
                <form action="{{route('Company.updatevacancy', ['vacancy_id'=> $vacancy->id])}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <label for="jobfield" class="addpostlabel">Job Vacancy Field:</label><br>
                  <input type="text" id="jobfield" name="jobfield" value="{{$vacancy->jobField}}" class="details">
                    @error('jobfield')
                          <div class="input-error">{{ $message }}</div>
                    @enderror
                    <br><br>
    
                  <label for="jobpost" class="addpostlabel">Job Vacancy Title:</label><br>
                  <input type="text" id="jobpost" name="jobpost" value="{{$vacancy->jobPost}}" class="details">
                    @error('jobpost')
                          <div class="input-error">{{ $message }}</div>
                    @enderror
                  <br><br>
    
                  <label for="salary" class="addpostlabel">Salary:</label><br>
                  <input type="text" id="salary" name="salary" value="{{$vacancy->salary}}" class="details">
                    @error('salary')
                          <div class="input-error">{{ $message }}</div>
                    @enderror
                    <br><br>
    
                  <label for="location" class="addpostlabel">Location:</label><br>
                  <input type="text" id="location" name="location" value="{{$vacancy->location}}" class="details">
                    @error('location')
                          <div class="input-error">{{ $message }}</div>
                    @enderror
                    <br><br>
    
                  <label for="flyerimg" class="addpostlabel">Flyer Images:</label><br>
                  Current Flyer image:<br>
                    <div class="row">
                        <div class="col-lg-8 col-11">
                            <img src="{{ asset('storage/'.$vacancy->flyer) }}" alt="Flyer Image" style="width: 80%; height: auto;  border: 3px solid #553d67;">
                        </div>
                        <div class="col-lg-4 col-1"></div>
                    </div>
                  <br>
                  New Flyer image:<br>
                  <input type="file" name="flyerimg" style="font-size:14px";>
                    @error('flyerimg')
                          <div class="input-error">{{ $message }}</div>
                    @enderror
                    <br><br><br>
    
                    <div style="text-align: center;">
                        <input type="submit" value="Submit" class="subBtn" ><br><br>
                    </div>
                
                </form>
        </div>
        <div class="col-lg-1"></div>
            
    </div>

        <br><br>
        <center>
			<div id="backbtndiv">
            <a href="{{route('Company.myposts')}}"> <button class="commonbtn">Back to MyPosts</button> </a>
            </div>
        </center>
        <hr style="color:#242582; height:3px;">

@endsection