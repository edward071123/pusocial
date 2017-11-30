@extends('layouts.appother')
@section('content')
    <script>
        var getName = "{{ $user->name }}";
        var getUid = "{{ $user->id }}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
    </script>
    <!--  <p class="visible-xs">
         <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
    </p>  -->
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
    <div class="for_mobile mobile_name" >{{ $user->name }}</div>
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
                                           <span style="float:left; margin-right:3px;">搜尋結果</span>
                                        </div>
    
    <!--朋友list-->

        <div style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
            @foreach($myfriends as $friend1)
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                        <a href="{{ url('/userpage/'.$friend1->puid) }}">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate  pro_delete" style=" padding:5px; " >
                                     @if(empty($friend1->avatar))
                                        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                                    @else
                                        <img src="{{ url('/uploads/avatars/'.$friend1->avatar)}}" width="100%">
                                    @endif
                            </div>
                        </a>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                            <div class="friend_box">
                                    <div style="width:100%; float:left; display:block;">
                                        <div class="friend_name">{{$friend1->name}}</div>
                                        <br><div class="friend_name">{{$friend1->puid}}</div>
                                    </div>
                            </div>
                        </div>
                    </div>
            @endforeach                              
             <!--朋友list end-->
   
       
   
    </div>
    
    
    </div>
    
        <!--右側廣告-->
    <div style="position:relative;">   
                                  <div id="sidebar3" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc" style="">
                                    
                                                                       
                                  
                              <div class="ad_body t_align_c" style="margin-bottom:15px;">
                                      
                                      <a href="#">
                                          <img src="images/ad_bannber01.png" alt="ad" class="m_bottom_10">
                                      </a>
                                      
                                      <a href="#">
                                          <img src="images/ad_bannber02.png" alt="ad" class="m_bottom_10">
                                      </a>
                                      
                                      <a href="#">
                                          <img src="images/ad_bannber03.png" alt="ad" class="m_bottom_10">
                                      </a>
                                      
                                      <a href="#">
                                          <img src="images/ad_bannber04.png" alt="ad" class="m_bottom_10">
                                      </a>
                                      
                                      <a href="#">
                                          <img src="images/ad_bannber05.png" alt="ad" class="m_bottom_10">
                                      </a>
                                      
                                </div>
                                </div>
       </div>
       <!--右側廣告 end-->
    
    </div>
    
    
    
    </div>
    
    
    
    <!-- <div style="position:relative;">   
        <div id="sidebar3" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.right_menu')
        </div>
    </div> -->
@endsection