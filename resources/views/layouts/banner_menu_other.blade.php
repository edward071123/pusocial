<a href="{{ url('/userpage/'.$user->puid) }}">  
    <div class="banner_menu">
        <div style="text-align:center;">
            <span style=""><img src="{{ asset('images/icon16.png') }}" width="30" height="30"></span>
            <span class="banner_text">動態</span>
        </div>
    </div>
</a >

<a href="{{ url('/friend/'.$user->puid) }}">  
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
<a href="{{ url('/album/'.$user->puid) }}">  
    <div class="banner_menu">
        <div style="text-align:center;">
            <span style=""><img src="{{ asset('images/icon18.png') }}" width="30" height="30"></span>
            <span class="banner_text">相簿</span>
        </div>
    </div>
</a >

