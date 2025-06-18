@extends('Company.layout')

@section('title', 'Add Vacancy')


@section('content')



<div class="heading">
    <u>Add Your Vacancy Details here to Post</u>
</div><br>
            <div class=" row ">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 addpost">
				
                <form action="{{route('Company.storevacancy')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <label for="jobfield" class="addpostlabel">Job Vacancy Field:</label><br>
                      <input type="text" id="jobfield" name="jobfield" class="details"  placeholder="Eg: Software Engineering" value="{{ old('jobfield') }}">
                      @error('jobfield')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>
        
                      <label for="jobpost" class="addpostlabel">Job Vacancy Title:</label><br>
                      <input type="text" id="jobpost" name="jobpost" class="details" placeholder="Eg: Full-Stack developer (Intern)">
                      @error('jobpost')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>
        
                      <label for="salary" class="addpostlabel">Salary Range:</label><br>
                      <input type="text" id="salary" name="salary" class="details" placeholder="Eg: LKR 30,000- 40,000">
                      @error('salary')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>
        
                      <label for="location" class="addpostlabel">Location:</label><br>
                      <input type="text" id="location" name="location" class="details" placeholder="Eg: North West, South West">
                      @error('location')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>
        
                      <label for="flyerimg" class="addpostlabel">Flyer Image:</label><br>
                      <input type="file" name="flyerimg" style="font-size:14px";>
                      @error('flyerimg')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>

                    <div style="text-align: center;">
                      <input type="submit" value="Submit" class="subBtn" ><br><br>
                    </div>
                      
                  </form>
                </div>
                <div class="col-lg-1"></div>
				
            </div>
			<br>

@endsection