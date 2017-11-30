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
           <!-- <div class="msg_left">
                <a href="#">
                    <div class=" people_pic3 link">
                        @if(empty(Auth::user()->avatar))
                            <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                        @else
                            <img src="{{ url('/uploads/avatars/'.Auth::user()->avatar)}}" width="100%">
                        @endif
                    </div>
                </a>
                <div class="msg_topbox">
                    <span class="people_msgli">{{ Auth::user()->name }}</span> 
                </div>
            </div>-->

            <div class="msg_right" style="width:100%;">
               <!-- <span class="msg_icon1"><img src="{{ asset('images/icon28.png') }}" width="15" height="15"></span>-->
                <span class="msg_text1">
                <textarea id="album_body"  class="msg_input form-control textarea-control" rows="3" placeholder="相簿主題"></textarea>
                </span>
            </div>
            <div class="msg_foot">
                <div class="msg_icon_li2">
                    <a href="javascript:void(0);">
                        <div class="people_left_top3 link" id="send_album">新增相簿</div>
                    </a>  
                </div>
            </div>
        </div>
        <div class="people_msg_title wow fadeInUp animated">
                <span style="float:left; margin-right:6px;"><img src="{{ asset('images/icon34.png') }}" width="56" height="56"></span>
                <span style="float:left; margin-right:3px;">相簿</span>
        </div>
         <div class="album_list" style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
                @foreach($aalbums as $album)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_bottom_40 m_sm_bottom_35 blog_animate wow fadeInUp animated " style="padding:10px;">
                        <figure class="shadow" style="border: 3px solid #ffffff; float:left;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  blog_animate link relative">
                                <div class="my_photo_bg">
                                
                                <div class="album_text">
                                         <a href="{{ url('/myalbumphoto/'.$album->id) }}">{{$album->title}}</a>
                                </div>
                                
                                <a href="javascript:void(0)" class="del_album" id="del_album_{{$album->id}}"><div class="del_link link" style="z-index: 9999;">link</div></a>
                                <a href="{{ url('/myalbumphoto/'.$album->id) }}">
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