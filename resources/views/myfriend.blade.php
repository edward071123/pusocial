@extends('layouts.appother')
@section('content')
    <script>
        var getName = "{{ Auth::user()->name }}";
        var getUid = "{{ Auth::user()->id }}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
    </script>

    <div>
       <div class="top_banner"
       @if(empty(Auth::user()->banner))
            style="background-image:url({{ asset('images/photo_bg.png') }}); position:relative;">
        @else
            style="background-image:url({{ url('/uploads/banners/'.Auth::user()->banner)}}); position:relative;">
        @endif
        <div class="my_title">{{Auth::user()->my_title}}</div>
            <div class="for_mobile mobile_people_pic">
              @if(empty(Auth::user()->avatar))
        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
    @else
        <img src="{{ url('/uploads/avatars/'.Auth::user()->avatar)}}" width="100%">
    @endif
            </div>
        </div>
    </div>
    <div class="for_mobile mobile_name" >{{ Auth::user()->name }}</div>
    <div class="for_mobile ">
        <div class="container" > 
            <div class="clearfix ">
                @include('layouts.left_menu')
            </div>
        </div>
    </div>
    <div class="banner_bg">
        <div class="container" > 
            <div class="clearfix row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr for_pc"   style=" padding:0px; "></div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12  blog_animate animate_ftr"   style=" padding:0px; ">
                    @include('layouts.banner_menu')
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="container">
 <div class="clearfix row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate " style="padding:10px;">  
    <!--左側-->
    <div style="position:relative; float:left;">   
        <div id="sidebar" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.left_menu')
        </div>
    </div>
    <!--中間-->
    
    <div id="m_hight" class="col-lg-7 col-md-7 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr"   style=" padding:10px; ">
       
        <div class="people_msg_title wow fadeInUp animated animated" style="visibility: visible; animation-name: fadeInUp;">
            <span style="float:left; margin-right:6px;"><img src="{{ asset('images/icon33.png') }}" width="56" height="56"></span>
            <span style="float:left; margin-right:3px;">朋友</span>
            <span style="float:left; font-size:18px; color:#808080;">　{{$friends}}位</span>
        </div>
    
    <!--朋友list-->

        <div style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
            @foreach($myfriends as $friend1)
                @if(Auth::user()->id == $friend1->from)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                        <a href="{{ url('/userpage/'.$friend1->u2puid) }}">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate  pro_delete" style=" padding:5px; " >
                                     @if(empty($friend1->u2avatar))
                                        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                                    @else
                                        <img src="{{ url('/uploads/avatars/'.$friend1->u2avatar)}}" width="100%">
                                    @endif
                            </div>
                        </a>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                            <div class="friend_box">
                                    <div style="width:100%; float:left; display:block;">
                                        <div class="friend_name">{{$friend1->u2name}}</div>
                                    </div>
                                    <a href="#">
                                        @if($friend1->check == 0)
                                           對方確認中...
                                           <div class="friend_button link pro_delete_invite" id="delete_invite_{{$friend1->id}}" style="width:100%;">刪除好友邀請</div>
                                        @else
                                             <div class="friend_button link pro_delete_friend" id="delete_friend_{{$friend1->id}}" style="width:100%;">取消好友</div>
                                        @endif
                                    </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                        <a href="{{ url('/userpage/'.$friend1->u1puid) }}">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate  pro_delete" style=" padding:5px; " >
                                    @if(empty($friend1->u1avatar))
                                        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                                    @else
                                        <img src="{{ url('/uploads/avatars/'.$friend1->u1avatar)}}" width="100%">
                                    @endif
                            </div>
                        </a>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                            <div class="friend_box">
                                    <div style="width:100%; float:left; display:blck;">
                                        <div class="friend_name">{{$friend1->u1name}}</div>
                                        <!--<div class="friend_no">356位</div>-->
                                    </div>
                                    <!--<div class="friend_text">
                                            <font style="font-weight:bold; color:#000000;">興趣：</font><br>
                                            將簡單的事件複雜化使其越作越忙！完樂台灣真有趣！啾咪...
                                    </div>-->
                                        @if($friend1->check == 0)
                                             <a href="#"><div class="friend_button promise_friend link" id="promise_friend_{{$friend1->id}}" style="width:100%;">答應加入好友</div></a>
                                            <a href="#">
                                             <div class="friend_button pro_delete_friend link" id="delete_friend_{{$friend1->id}}" style="width:100%;">拒絕加入好友</div></a>
                                        @else
                                             <a href="#"><div class="friend_button link pro_delete_friend" id="delete_friend_{{$friend1->id}}" style="width:100%;">取消好友</div> </a>
                                        @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach                              
             <!--朋友list end-->
   
       
   
    </div>
    
    
    </div>
    
        <!--右側廣告-->
        @include('commercial')
       <!--右側廣告 end-->
    
    </div>
    
    
    
    </div>
    
    
    
    <!-- <div style="position:relative;">   
        <div id="sidebar3" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.right_menu')
        </div>
    </div> -->
@endsection