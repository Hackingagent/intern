@extends('Company.layout')

@section('title', 'Message')


@section('content')


<hr style="color:#242582; height:3px;">
			
<div class="row">

    <a href="{{route('Company.message')}}">  
        <div class="chatbackbtn">
            <button type="button" class="btn btn-primary">Back to Messages</button>
        </div>
    </a>
<br>
<div class="chatdivbox">
<div class="chat">
    @foreach($messages as $message)
        <div class="msg">
        <br>
        <b>
       {{$message->heading}}
        :
        </b>
        {{$message->message}}
        <br>
        <small>
        {{$message->updated_at}} 
        </small>
        </div>
    @endforeach
</div>
<div class="typebox">
    <form action="{{route('Company.sendmsg')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        <textarea rows="5" cols="60" name="newmsg" id="newmsg"></textarea>
        <input type="hidden" name="sender_id" value="{{ $sender_id }}">
        <input type="hidden" name="sender_type" value="{{ $sender_type }}">
        <div>
            <button type="submit" class="commonbtn">Send</button>
        </div>
        <br>

    </form>
</div>
</div>


</div>
<br>
<hr style="color:#242582; height:3px;">

@endsection