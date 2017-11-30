
<div class="people_pic for_pc ">
    @if(empty($user->avatar))
        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
    @else
        <img src="{{ url('/uploads/avatars/'.$user->avatar)}}" width="100%">
    @endif
</div>
<div class="index_name for_pc">{{ $user->name }}</div>
<div class="people_left01">
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon02.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">興趣：</span>
        <span style="display:inline-block; float:left; color:#636363">
            @foreach($u_interests as $interest)
                {{$interest->interest_name}}、
            @endforeach
        </span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon03.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">朋友：</span>
        <span style="display:inline-block; float:left; color:#636363">{{$friends}}位</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon04.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">來自：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ $user->live }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon05.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">生日：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ $user->birthday }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon06.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">工作：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ $user->job }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon07.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">學歷：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ $user->edu }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon08.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">語言：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ $user->lan }}</span>
    </li>
</div>







<div class="people_left01">

<a href="{{ url('/friend/'.$user->puid) }}">
<li class="people_li2">
<span class="people_icon01"><img src="{{ asset('images/icon12.png') }}" width="19" height="19"></span>
<span style="display:inline-block; float:left; font-weight:bold; color:#000000;">朋友</span>

</li>
</a>

<a href="javascript:void(0);"  class="add_friend" id = "add_fd_{{$user->id}}">
    <li class="people_li2">
    <span class="people_icon01"><img src="{{ asset('images/icon13.png') }}" width="19" height="19"></span>
    <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">加入好友</span>

    </li>
</a>
<a href="javascript:void(0);">
<a href="javascript:void(0);" class="popuproom" id="room_room-{{$user->id}}_{{$user->name}}">
    <li class="people_li2">
    <span class="people_icon01"><img src="{{ asset('images/icon13.png') }}" width="19" height="19"></span>
    <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">即時聊天</span>

    </li>
</a>


</div>


