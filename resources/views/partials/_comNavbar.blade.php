

<div class="row sticky">
    <ul class="nav nav-pills nav-justified navbarclr">
      <li class="nav-item" >
        <a class="nav-link  {{ Request::path() == 'Company/home' ? 'active' : '' }}" href="{{route('Company.home')}}"> <img src="{{ asset ('images/icon/addpost.png') }}" alt="Add Post" style="width: 34px; height: 34px;" class="btnicon"> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'Company/message'  || Request::path() == 'Company/msgbody' ? 'active' : '' }}" href="{{route('Company.message')}}"><img src="{{ asset ('images/icon/msgwhite.png') }}" alt="Messages" style="width: 34px; height: 34px;" class="btnicon"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{ Request::path() == 'Company/comnotification' ? 'active' : '' }}" href="{{route('Company.comnotification')}}"><img src="{{ asset ('images/icon/notificationwhite.png') }}" alt="Notification" style="width: 34px; height: 34px;" class="btnicon"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link   {{ Request::path() == 'Company/myposts' || Request::path() == 'Company/editpost' ? 'active' : '' }}" href="{{route('Company.myposts')}}"><img src="{{ asset ('images/icon/mypost.png') }}" alt="My Post" style="width: 34px; height: 34px;" class="btnicon"></a>
      </li>
    </ul>
  </div>