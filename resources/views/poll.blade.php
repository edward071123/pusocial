@extends('layouts.app')
@section('content')
    <script>
        var getName = "{{Auth::user()->name}}";
        var getUid = "{{Auth::user()->id}}";
        var getUserAvatar = "{{ asset('uploads/avatars').'/'. Auth::user()->avatar}}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
    </script>
    <p class="visible-xs">
         <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
    </p>
    <div>
        <div class="top_banner"  style="background-image:url({{ asset('images/photo_bg.png') }})">
            <div class="for_mobile mobile_people_pic"><img src="{{ asset('images/photo.png') }}" width="100%"></div>
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
        <div style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
                @foreach($voters as $vote)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr "    style=" padding:10px; ">
                        <div class=" wow fadeInUp animated" data-wow-delay="200ms">
                            <a href="#">
                                <div class="people_pic2 link ">
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
                                    <div class="people_list1" >票數：<span id="poll_count_{{ $vote->id}}">{{ $vote->votecount}}</span>票</div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="send_poll" id="poll_{{$vote->id}}">
                            <div class="vote_button">投他一票</div>
                            </a>
                        </div>
                    </div>
                @endforeach                		
    </div>
    
    </div>
    </div>
    </div>
    <!-- <div style="position:relative;">   
        <div id="sidebar3" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.right_menu')
        </div>
    </div> -->
@endsection