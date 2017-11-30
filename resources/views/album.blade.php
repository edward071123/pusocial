@extends('layouts.app')
@section('content')
    <script>
        var getName = "{{Auth::user()->name}}";
        var getUid = "{{Auth::user()->id}}";
        var getUserAvatar = "{{ asset('uploads/avatars').'/'. Auth::user()->avatar}}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
        var photoPagePath = "{{ url('/myalbumphoto/') }}";
    </script>
     <div class="top_banner"
       @if(empty($user->banner))
            style="background-image:url({{ asset('images/photo_bg.png') }}); position:relative;">
        @else
            style="background-image:url({{ url('/uploads/banners/'.$user->banner)}}); position:relative;">
        @endif
        <div class="my_title">{{$user->my_title}}</div>
            <div class="for_mobile mobile_people_pic">
              @if(empty(Auth::user()->avatar))
        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
    @else
        <img src="{{ url('/uploads/avatars/'.$user->avatar)}}" width="100%">
    @endif
            </div>
        </div>
    </div>
    <div class="for_mobile mobile_name" >{{ Auth::user()->name }}</div>
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
                <span style="float:left; margin-right:6px;"><img src="{{ asset('images/icon34.png') }}" width="56" height="56"></span>
                <span style="float:left; margin-right:3px;">相簿</span>
        </div>
         <div class="album_list" style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
                @foreach($aalbums as $album)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_bottom_40 m_sm_bottom_35 blog_animate wow fadeInUp animated " style="padding:10px;">
                        <figure  class="shadow" style="border: 3px solid #ffffff; float:left;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  blog_animate link relative">
                                <div class="my_photo_bg">
                                <div class="album_text">
                                         <a href="{{ url('/albumphoto/'.$user->puid.'/'.$album->id) }}">{{$album->title}}</a>
                                        
                                    </div>
                                <a href="{{ url('/albumphoto/'.$user->puid.'/'.$album->id) }}">
                                    @if(empty($album->cover))
                                        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                                    @else
                                        <img src="{{ url('/uploads/album/'.$album->id.'/'.$album->cover) }}" width="100%">
                                    @endif
                                    
                                    <!--<div class="album_link link">link</div>-->
                                     </a>
                                </div>
                                </div>
                           
                            
                            <!--description and price of product-->
                            <figcaption>  
                                <div class="album_box">
                                   
                                    <font>{{$album->photocount}}張相片</font>
                                </div>
                            </figcaption> 
                        </figure>
                    </div>
                @endforeach                		
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