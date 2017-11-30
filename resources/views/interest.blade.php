@extends('layouts.app')
@section('content')
    <script>
        var getName = "{{Auth::user()->name}}";
        var getUid = "{{Auth::user()->id}}";
        var getUserAvatar = "{{ asset('uploads/avatars').'/'. Auth::user()->avatar}}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
        var userPagePath = "{{ url('/userpage') }}";
    </script>
    <p class="visible-xs">
         <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
    </p>
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
                    <div class="msg_bg1 wow fadeInUp animated">
                        <select id="interest_compare_body" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="請輸入興趣" style="width:100%;">
                            @foreach($u_interests as $interest)
                                <option value="{{$interest->interest_name}}">{{$interest->interest_name}}</option>
                            @endforeach
                        </select>
                    <div class="msg_foot">
                        <div class="msg_icon_li2">
                            <a href="javascript:void(0);">
                                <div class="people_left_top3 link" id="send_compare">比對</div>
                            </a>  
                        </div>
                    </div>
                    <div class="people_msg_title wow fadeInUp animated">
                        <span style="float:left; margin-right:6px;"><img src="images/icon36.png" width="56" height="56"></span>
                        <span style="float:left; margin-right:3px;">和我興趣相同的人</span>
                    </div>
                    <div class="interest_compare_list" style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
                        
                    </div>                    		
                </div>
            </div>
            
                <!--右側廣告-->
        @include('commercial')
       <!--右側廣告 end-->
            
            
        </div>
    </div>
@endsection
