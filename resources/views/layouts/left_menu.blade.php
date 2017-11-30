<div class="people_pic for_pc ">
    @if(empty(Auth::user()->avatar))
        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
    @else
        <img src="{{ url('/uploads/avatars/'.Auth::user()->avatar)}}" width="100%">
    @endif
</div>
<div class="index_name for_pc">{{ Auth::user()->name }}</div>
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
        <span style="display:inline-block; float:left; color:#636363">{{ Auth::user()->live }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon05.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">生日：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ Auth::user()->birthday }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon06.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">工作：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ Auth::user()->job }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon07.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">學歷：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ Auth::user()->edu }}</span>
    </li>
    <li class="people_li">
        <span class="people_icon01"><img src="{{ asset('images/icon08.png') }}" width="19" height="19"></span>
        <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">語言：</span>
        <span style="display:inline-block; float:left; color:#636363">{{ Auth::user()->lan }}</span>
    </li>
</div>







<div class="people_left01">

<a href="{{ url('/home') }}">
<li class="people_li2">
<span  class="people_icon01"><img src="{{ asset('images/icon09.png') }}" width="19" height="19"></span>
<span style="display:inline-block; float:left; font-weight:bold; color:#000000;">首頁</span>

</li>
</a>


<a href="{{ url('/user/'.Auth::id()) }}">
<li class="people_li2">
<span  class="people_icon01"><img src="{{ asset('images/icon10.png') }}" width="19" height="19"></span>
<span style="display:inline-block; float:left; font-weight:bold; color:#000000;">個人主頁</span>

</li>
</a>

<a href="{{ url('/mypage') }}">
<li class="people_li2">
<span class="people_icon01"><img src="{{ asset('images/icon11.png') }}" width="19" height="19"></span>
<span style="display:inline-block; float:left; font-weight:bold; color:#000000;">動態</span>

</li>
</a>

<a href="{{ url('/myfriend') }}">
<li class="people_li2">
<span class="people_icon01"><img src="{{ asset('images/icon12.png') }}" width="19" height="19"></span>
<span style="display:inline-block; float:left; font-weight:bold; color:#000000;">朋友</span>

</li>
</a>

<a href="{{ url('/interestcompare') }}">
<li class="people_li2">
<span class="people_icon01"><img src="{{ asset('images/icon13.png') }}" width="19" height="19"></span>
<span style="display:inline-block; float:left; font-weight:bold; color:#000000;">興趣</span>

</li>
</a>



</div>





<div class="people_left01" style="margin-bottom:15px;">

<!--<a href="information.php">
<li class="people_li2">
<span  class="people_icon01"><img src="images/icon14.png" width="19" height="19"></span>
<span style="display:inline-block; float:left; font-weight:bold; color:#000000;">設定</span>

</li>
</a>


-->
    <a href="{{ url('/myinterest') }}">
        <li class="people_li2">
            <span  class="people_icon01"><img src="{{ asset('images/icon15.png') }}" width="19" height="19"></span>
            <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">個人興趣設定</span>
        </li>
    </a>
    <!-- <a href="#">
        <li class="people_li2">
            <span  class="people_icon01"><img src="images/icon15.png" width="19" height="19"></span>
            <span style="display:inline-block; float:left; font-weight:bold; color:#000000;">隱私設定</span>
        </li>
    </a> -->
</div>




<a href="#">
<div class="people_left_top link">最新</div>
</a>  

@foreach($albums as $album)
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:8px; ">
    <div style="width:100%; height:109px; overflow:hidden;">
        <a href="{{ url('/myalbumphoto/'.$album->id) }}">
            @if(empty($album->cover))
                <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%" class="link">
            @else
                <img src="{{ url('/uploads/album/'.$album->id.'/'.$album->cover) }}" width="100%" class="link">
            @endif
        </a>
        </div>
    </div>
@endforeach
