@extends('Company.layout')

@section('title', 'Messages-Company')

@section('content')

<hr style="color:#242582; height:3px;">

            <div class="row">
				<center>
                <div class="newchatHeads">
				
					<div class="heading">
					<img src="{{ asset ('images/icon/Unread.png') }}" alt="Unread icon" style="width: 32px; height: 40px;">
					<u> New Messages</u>
					</div>
				
					<table style="border:3px solid #2f2fa2; width: 60%;">
					
						@foreach($messages as $newmsg)
							<tr style="border:1px solid #242582;">
							<td>
								<a href="{{route('Company.msgbody', ['sender_id' => $newmsg->sender_id , 'sender_type'=> $newmsg->sender_type])}}">
									<div class="heads">
										<h5>
										<img src="{{ asset ('images/icon/Unread.png') }}" alt="Unread icon" style="width: 26px; height:34px;">
										{{$newmsg->heading}} </h5>
									</div>
								</a>
							</td>
							<td>
								<a href="{{route('Company.seenmsg', ['msg_id' => $newmsg->id])}}"> 
									<div class="marbtndiv">
										<br>
											<button type="button" class="markasread">Mark as Read</button>
									</div>
								</a>
								<br>
							</td>
						
							</tr>
							<br>
						@endforeach
			
					</table>
				</div>
				</center>
            </div>
			<br><br>
			<hr style="color:#242582; height:3px;">
			<br>
			
    
			<div class="row">
                <div class="oldchatHeads">
					<div class="heading">
					<img src="{{asset( 'images/icon/readmsg.png')}} " alt="Unread messages" style="width: 32px; height: 38px;">
					<u> Old Messages</u>
					</div>
					<br>
					
                    @foreach($oldmessages as $oldmsg)
                    <a href="{{route('Company.msgbody', ['sender_id' => $oldmsg->sender_id, 'sender_type' => $oldmsg->sender_type])}}">
						<div class="heads">
							<h5>
								<img src="{{asset( 'images/icon/readmsg.png') }}" alt="Unread messages" style="width: 28px; height: 32px;">
								{{$oldmsg->heading}} 
							</h5>
						</div>
                    </a>
					
                    @endforeach
				
                </div>
            </div>

            <hr style="color:#242582; height:3px;">

@endsection