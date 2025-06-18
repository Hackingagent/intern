@extends('Student.layout')

@section('title', 'Notifications')

@section('content')

<div class="row" id="newNotifications">
    <h1 style="color:blue; font-family: verdana; font-size: 120%;"><u> New Notifications</u></h1>
    <ul>
    @foreach($newNotifications as $newNotification)
    <hr style="color:#242582; height:3px;">
    <div class="row">
        <div class="col-1 col-sm-1"></div>
            <div class="col-10 col-sm-10 notibody" >
                <br>
                <div class="singlenotification"  style="float: left;">
                    <div class="notitext">
                        <li>
                         {{$newNotification->notification}} 
                        <br><small> {{$newNotification->updated_at}} </small><br>
                        <br>
                        <a href="{{route('Student.readNotification', ['notification_id'=> $newNotification->id])}}"> <button class="removenotification">Mark as read</button></a>
                    </li>
                    </div><br>	
                </div>
            </div>
        <div class="col-1 col-sm-1"></div>	
    </div>
    @endforeach
</ul>

</div>
<hr style="color:#242582; height:3px;">
<br><br>

<div class="row" id="oldNotifications">
    <h1 style="color:blue; font-family: verdana; font-size: 120%;"><u>Marked as read</u> </h1>
    <ul>
    @foreach($oldNotifications as $oldNotification)
    <hr style="color:#242582; height:3px;">
    <div class="row">
        <div class="col-1 col-sm-1"></div>
            <div class="col-10 col-sm-10 notibody" >
                <br>
                <div class="singlenotification"  style="float: left;">
                    <div class="notitext">
                        <li>  {{$oldNotification->notification}} 
                        <br><small> {{$oldNotification->updated_at}} </small><br>
                    </li>
                    </div><br>	
                </div>
            </div>
        <div class="col-1 col-sm-1"></div>
    </div>
    @endforeach
</ul>

</div>

@endsection