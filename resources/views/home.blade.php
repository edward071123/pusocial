@extends('layouts.app')
@section('content')
    <script>
        var getName = "{{Auth::user()->name}}";
        var getUid = "{{Auth::user()->id}}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
        var sendPostPath = "{{ url('/sendpost') }}";
        var sendCommentPath = "{{ url('/sendcomment') }}";
         var postPicPath = "{{ asset('uploads/posts').'/' }}";
         var showPath = "{{ url('/show') }}";
    </script>
   <!-- <p class="visible-xs">
         <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
    </p>-->
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
            @foreach($voters as $vote)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr "   style=" padding:10px; ">
            <div class=" wow fadeInUp animated" data-wow-delay="300ms">
                <a href="{{ url('/userpage/'.$vote->puid) }}">
                    <div class="people_pic2 link">
                        @if(empty($vote->avatar))
                            <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                        @else
                            <img src="{{ url('/uploads/avatars/'.$vote->avatar)}}" width="100%">
                        @endif
                    </div>
                </a>
                <div class="people_box">
                    <div class="people_name1">{{ $vote->name}}</div>
                    <div class="people_down">
                        <div class="people_list1">票數：<span id="poll_count_{{ $vote->id}}">{{ $vote->votecount}}</span>票</div>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
        
        <div class="people_msg_title wow fadeInUp animated">
            <span style="float:left; margin-right:6px;"><img src="images/icon29.png" width="56" height="56"></span>
            <span style="float:left;">動態</span>
        </div>
        <div class="list_past_msg">
            @foreach($posts as $post)
                @include('userpagepost')
            @endforeach
        </div>
    </div>
    
    
    
        <!--右側廣告-->
    @include('commercial')
       <!--右側廣告 end-->
    
    </div>
    </div>
    </div>
@endsection