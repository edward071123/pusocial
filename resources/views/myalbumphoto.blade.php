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
          <!--  <div class="msg_left">
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

            <form action="/pusocial/addphoto" method="post" enctype="multipart/form-data">
                <div class="msg_right" style="width:100%;">
                <input class="login_pic_upload t_align_c" type="file" name="photos[]"  multiple value="選擇檔案"  style="width:100%;">
                </div>
                <div class="msg_foot">
                    <div class="msg_icon_li2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="albumid" value="{{$album->id}}">
                        <input type="submit" class="people_left_top3 link" value="新增相片">
                    </div>
                </div>
            </form>
        </div>
        <div class="people_msg_title wow fadeInUp animated">
                <span style="float:left; margin-right:6px;"><img src="../images/icon34.png" width="56" height="56"></span>
                <span style="float:left; margin-right:3px;">{{$album->title}}相簿</span>
        </div>
         <div class="album_list" style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
    @foreach($photos as $photo)
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35  blog_animate wow fadeInUp animated ">
            <!--product item-->
            <div class="product_item">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    
                    <a href="javascript:void(0)" class="del_photo" id="del_photo_{{$photo->id}}"><div class="del_link link" style="z-index: 9999;">刪除</div></a>
                        <!--hot product-->
                       
                       <a data-fancybox data-src="#hidden-content-a{{$photo->id}}" href="javascript:;" class="d_block relative pp_wrap">
                        
                       <div class="my_photo_bg" style="position:relative;">
                            @if(empty($photo->photo_path))
                                <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                            @else
                                <img src="{{ url('/uploads/album/'.$photo->album_id.'/'.$photo->photo_path)}}" width="100%">
                            @endif
                        </div>
                       
                        <span data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">瀏覽</span>
                        </a>
                        
                       <a data-fancybox data-src="#hidden-content-b{{$photo->id}}" href="javascript:;" >
                        <div class="album_edit link">編輯</div>
                        </a>
                   
                </figure>
            </div>   
        </div>
        <!--瀏覽畫面-->
        <div style="display: none;" id="hidden-content-a{{$photo->id}}">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 ">
                <img src="{{ url('/uploads/album/'.$photo->album_id.'/'.$photo->photo_path)}}" width="100%" class="tr_all_hover" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 " style="padding:0px 10px;">
                <div class="photo_title-name">{{ Auth::user()->name }}相簿</div>
                <div class="photo_title-day">{{$photo->create_date}}</div>
                <div class="photo_text_p">
                {{$photo->content}}
                </div>
            </div>
        </div>
        <!--瀏覽畫面 end-->
        <!--編輯畫面-->
     <div style="display: none;" id="hidden-content-b{{$photo->id}}">
         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 ">
             <img src="{{ url('/uploads/album/'.$photo->album_id.'/'.$photo->photo_path)}}" width="100%" class="tr_all_hover" alt="">
         </div>
         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 " style="padding:0px 10px;">
             <div class="photo_title-name">{{ Auth::user()->name }}相簿</div>
             <div class="photo_title-day">{{$photo->create_date}}</div>
             <div class="photo_text_p">
               <textarea id="photo_content_{{$photo->id}}" style="width:100%; height:180px;" placeholder="請輸入說明文字">{{$photo->content}}</textarea>
             </div>
             <a href="javascript:void(0)" class="send_photo_content_btn" id="send_photo_content_{{$photo->id}}">
                <div class="people_left_top3 link" class=>儲存</div>
             </a>
             
         </div>
     </div>
    <!--編輯畫面 end-->
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