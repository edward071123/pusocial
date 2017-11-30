@extends('layouts.app')
@section('content')
    <script>
        var getAuthUid = "{{Auth::user()->id}}";
        var getName = "{{ $user->name }}";
        var getUid = "{{Auth::user()->id}}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
        var sendCommentPath = "{{ url('/sendcomment') }}";
         var postPicPath = "{{ asset('uploads/posts').'/' }}";
         var showPath = "{{ url('/show') }}";
    </script>
    <p class="visible-xs">
         <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
    </p>
    <div>
       <div class="top_banner"  
            @if(empty($user->banner))
                style="background-image:url({{ asset('images/photo_bg.png') }}); position:relative;">
            @else
                style="background-image:url({{ url('/uploads/banners/'.$user->banner)}}); position:relative;">
            @endif
        <div class="my_title">{{$user->my_title}}</div>
            <div class="for_mobile mobile_people_pic">
              @if(empty($user->avatar))
                <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
            @else
                <img src="{{ url('/uploads/avatars/'.$user->avatar)}}" width="100%">
            @endif
            </div>
        </div>
    </div>
    <div class="for_mobile mobile_name" >{{ $user->name }}</div>
    <div class="for_mobile ">
        <div class="container" > 
            <div class="clearfix ">
                @include('layouts.left_other_menu')
            </div>
        </div>
    </div>
    <div class="banner_bg">
        <div class="container" > 
            <div class="clearfix row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr for_pc"   style=" padding:0px; "></div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12  blog_animate animate_ftr"   style=" padding:0px; ">
                    @include('layouts.banner_menu_other')
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
            @include('layouts.left_other_menu')
        </div>
    </div>
    <!--中間-->
    <div id="m_hight" class="col-lg-7 col-md-7 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr"   style=" padding:10px; ">
        <div class="people_msg_title wow fadeInUp animated">
            <span style="float:left; margin-right:6px;"><img src="{{ asset('images/icon29.png') }}" width="56" height="56"></span>
            <span style="float:left;">動態</span>
        </div>
        <div class="list_past_msg">
            @foreach($posts as $post)
                @if($post->active == 3)
                   @include('userpagepost')
                @elseif ($post->active == 2)
                    @if($fstatus == 1)
                        @include('userpagepost')
                    @endif
                @endif
            @endforeach
        </div>
    </div>
  
                                  
       <!--右側廣告-->
         @include('commercial')
       <!--右側廣告 end-->                            
                                  
                                  
    
    </div>
    
    </div>
    </div>
    <!-- <div style="position:relative;">   
        <div id="sidebar3" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.right_menu')
        </div>
    </div> -->
@endsection