@extends('Student.layout')

@section('title', 'Apply for this Internship')

@section('content')

<div class="heading">
    <u>Upload The following Documents to apply for this Internship</u>
</div><br>
            <div class=" row ">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 addpost">

                <form action="{{ route('Student.apply.perform', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                      {{-- <label for="jobfield" class="addpostlabel">Job Vacancy Field:</label><br>
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
                      <input type="text" id="location" name="location" class="details" placeholder="Eg: Colombo, Sri Lanka">
                      @error('location')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br> --}}

                      <label for="cv" class="addpostlabel">Upload CV:</label><br>
                      <input type="file" name="cv" style="font-size:14px";>
                      @error('cv')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>



                      <label for="cover" class="addpostlabel">Upload Cover Letter</label><br>
                      <input type="file" name="cover" style="font-size:14px";>
                      @error('cover')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>



                      <label for="id" class="addpostlabel">Upload Id Card</label><br>
                      <input type="file" name="id" style="font-size:14px";>
                      @error('id')
                          <div class="input-error">{{ $message }}</div>
                      @enderror
                      <br><br>




                      <label for="additional" class="addpostlabel">Any Additional Document:</label><br>
                      <input type="file" name="additional" style="font-size:14px";>
                      @error('additional')
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