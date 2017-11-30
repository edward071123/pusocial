<a href="{{ url('/mypage') }}">  
    <div class="banner_menu">
        <div style="text-align:center;">
            <span style=""><img src="{{ asset('images/icon16.png') }}" width="30" height="30"></span>
            <span class="banner_text">動態</span>
        </div>
    </div>
</a >

<a href="{{ url('/myfriend') }}">  
    <div class="banner_menu" style="position:relative;">
        <div class="indexmenu_icon">{{$friends}}
            <span class="icon_bg1"><img src="{{ asset('images/icon.png') }}" width="9" height="5"></span>
        </div>
        <div style="text-align:center; ">
            <span style=""><img src="{{ asset('images/icon17.png') }}" width="30" height="30"></span>
            <span class="banner_text">朋友</span>
        </div>
    </div>
</a >
<a href="{{ url('/myalbum') }}">  
    <div class="banner_menu">
        <div style="text-align:center;">
            <span style=""><img src="{{ asset('images/icon18.png') }}" width="30" height="30"></span>
            <span class="banner_text">相簿</span>
        </div>
    </div>
</a >
<a href="{{ url('/interestcompare') }}">  
    <div class="banner_menu">
        <div style="text-align:center;">
            <span style=""><img src="{{ asset('images/icon19.png') }}" width="30" height="30"></span>
            <span class="banner_text">興趣</span>
        </div>
    </div>
</a >
<a href="{{ url('/user/'.Auth::id()) }}">  
    <div class="banner_menu">
        <div style="text-align:center;">
            <span style=""><img src="{{ asset('images/icon20.png') }}" width="30" height="30"></span>
            <span class="banner_text">個人資料</span>
        </div>
    </div>
</a >