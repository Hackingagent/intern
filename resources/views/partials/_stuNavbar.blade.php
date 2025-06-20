
<div class="row sticky">
    <ul class="nav nav-pills nav-justified navbarclr">
      <li class="nav-item" >
        <a class="nav-link  {{ Request::path() == 'Student/feed' ? 'active' : '' }}" href="{{route('Student.StuFeed')}}"> <img src="{{ asset ('images/icon/feedwhite.png') }}" alt="Feed" style="width: 34px; height: 34px;" class="btnicon"> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'Student/message'  || Request::path() == 'Student/msgbody' ? 'active' : '' }}" href="{{route('Student.message')}}"><img src="{{ asset ('images/icon/msgwhite.png') }}" alt="Messages" style="width: 34px; height: 34px;" class="btnicon"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{ Request::path() == 'Student/stuNotification' ? 'active' : '' }}" href="{{route('Student.stuNotification')}}"><img src="{{ asset ('images/icon/notificationwhite.png') }}" alt="Notification" style="width: 34px; height: 34px;" class="btnicon"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link   {{ Request::path() == 'Student/favorite' ? 'active' : '' }}" href="{{route('Student.favorite')}}"><img src="{{ asset ('images/icon/favoritewhite.png') }}" alt="Favorite" style="width: 34px; height: 34px;" class="btnicon"></a>
      </li>

      <li class="nav-item">
        <a class="nav-link   {{ Request::path() == 'map' ? 'active' : '' }}" href="{{route('map')}}"><img src="{{ asset ('images/icon/map.jpg') }}" alt="Favorite" style="width: 34px; height: 34px;" class="btnicon"></a>
      </li>
    </ul>
  </div>