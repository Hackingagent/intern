@extends('Student.layout')

{{-- @section('title', 'Student Feed') --}}

@section('content')
<hr style="color:#242582; height:3px;">
	@foreach ($vacancies as $vacancy)

			<div class="row" id="myposts">
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10" align="center">
						<div class="feedposttitle" align="left">
							<h3><img src="{{asset('storage/'.$vacancy->company->profilePic)}}" style="width: 36px; height: 36px;" class="feedtitleicon"> {{ $vacancy->company->name }} had posted a vacancy on {{$vacancy->jobPost}}  </h3>
							<small>{{$vacancy->updated_at->format('F d, Y')}}</small>
						</div>
					</div>
					<div class="col-lg-1"></div>
				</div>

				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10 feedpostcontent" >
						<br>
						<div class="row">
							<div class="col-md-6 col-12 img" >
								<img src="{{ asset('storage/'.$vacancy->flyer) }}" style="width: 100%; height: 100%;" alt="postImg">
							</div>
							<div class="col-md-6 d-none d-md-block " >
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

                            <div class="col-4"><a href="{{route('Student.apply.perform',  $vacancy->id)}}"><button class="applybtn">Apply</button></a></div>

                            <div class="col-4"><a href="{{route('Student.addfavorite', ['vacancy_id' => $vacancy->id])}}"><button class="favoritebtn">Add to favorite</button></a></div>

							{{-- @if(\App\Models\StudentApply::where('student_id', Auth::guard('student')->user()->id)->where('post_id', $vacancy->id)->exists())
								<div class="col-4"><button class="favoritebtn-success">Already Applied</button></div>
							@else
								<div class="col-4"><a href="{{route('Student.apply.perform', $vacancy->id)}}"><button class="applybtn">Apply</button></a></div>
							@endif


							@if(\App\Models\StudentFavorite::where('student_id', Auth::guard('student')->user()->id)->where('post_id', $vacancy->id)->exists())
								<div class="col-4"><button class="favoritebtn-success">Already added to favorites</button></div>
							@else
								<div class="col-4"><a href="{{route('Student.addfavorite', ['vacancy_id' => $vacancy->id])}}"><button class="favoritebtn">Add to favorite</button></a></div>
							@endif --}}


							<div class="col-4"><a href="{{route('seeMore', ['vacancy_id' => $vacancy->id])}}"><button class="seemore">See More...</button></a></div>

						</div>

					</div>

					<div class="col-lg-1"></div>
				</div>

			</div>
			<br>
			<hr style="color:#242582; height:3px;">
			@endforeach








    @endsection
