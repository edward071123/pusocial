@extends('layouts.appother')
@section('content')
    <script>
        var getAuthUid = "{{Auth::user()->id}}";
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
        <div class="top_banner"  style="background-image:url({{ asset('images/photo_bg.png') }})">
            <div class="for_mobile mobile_people_pic"><img src="{{ asset('images/photo.png') }}" width="100%"></div>
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
                    @include('layouts.banner_menu')
                </div>
            </div>
        </div>
    </div>
    
    <!--左側-->
    <div style="position:relative; float:left;">   
        <div id="sidebar" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.left_other_menu')
        </div>
    </div>
    <!--中間-->
     <!--朋友list-->
                                        <div style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
                                        
                                                <!--1-->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                                                    <a href="#">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate link" style=" padding:5px; " >
                                                              <img src="images/photo2.png" width="100%">
                                                        </div>
                                                    </a>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                                                        <div class="friend_box">
                                                              <div style="width:100%; float:left; display:block;">
                                                                 <div class="friend_name">蔡阿文</div>
                                                                 <div class="friend_no">356位</div>
                                                              </div>
                                                              <div class="friend_text">
                                                                     <font style="font-weight:bold; color:#000000;">興趣：</font><br>
                                                                     將簡單的事件複雜化使其越作越忙！完樂台灣真有趣！啾咪...
                                                              </div>
                                                              <a href="#">
                                                                   <div class="friend_button link">取消此友</div>
                                                              </a>
                                                        </div>
                                                   </div>
                                                </div>
                                                <!--2-->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                                                    <a href="#">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate link" style=" padding:5px; " >
                                                              <img src="images/photo2.png" width="100%">
                                                        </div>
                                                    </a>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                                                        <div class="friend_box">
                                                              <div style="width:100%; float:left; display:block;">
                                                                 <div class="friend_name">蔡阿文</div>
                                                                 <div class="friend_no">356位</div>
                                                              </div>
                                                              <div class="friend_text">
                                                                     <font style="font-weight:bold; color:#000000;">興趣：</font><br>
                                                                     將簡單的事件複雜化使其越作越忙！完樂台灣真有趣！啾咪...
                                                              </div>
                                                              <a href="#">
                                                                   <div class="friend_button link">取消此友</div>
                                                              </a>
                                                        </div>
                                                   </div>
                                                </div>
                                                <!--3-->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                                                    <a href="#">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate link" style=" padding:5px; " >
                                                              <img src="images/photo2.png" width="100%">
                                                        </div>
                                                    </a>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                                                        <div class="friend_box">
                                                              <div style="width:100%; float:left; display:block;">
                                                                 <div class="friend_name">蔡阿文</div>
                                                                 <div class="friend_no">356位</div>
                                                              </div>
                                                              <div class="friend_text">
                                                                     <font style="font-weight:bold; color:#000000;">興趣：</font><br>
                                                                     將簡單的事件複雜化使其越作越忙！完樂台灣真有趣！啾咪...
                                                              </div>
                                                              <a href="#">
                                                                   <div class="friend_button link">取消此友</div>
                                                              </a>
                                                        </div>
                                                   </div>
                                                </div>
                                                <!--4-->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                                                    <a href="#">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate link" style=" padding:5px; " >
                                                              <img src="images/photo2.png" width="100%">
                                                        </div>
                                                    </a>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                                                        <div class="friend_box">
                                                              <div style="width:100%; float:left; display:block;">
                                                                 <div class="friend_name">蔡阿文</div>
                                                                 <div class="friend_no">356位</div>
                                                              </div>
                                                              <div class="friend_text">
                                                                     <font style="font-weight:bold; color:#000000;">興趣：</font><br>
                                                                     將簡單的事件複雜化使其越作越忙！完樂台灣真有趣！啾咪...
                                                              </div>
                                                              <a href="#">
                                                                   <div class="friend_button link">取消此友</div>
                                                              </a>
                                                        </div>
                                                   </div>
                                                </div>
                                                <!--5-->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                                                    <a href="#">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate link" style=" padding:5px; " >
                                                              <img src="images/photo2.png" width="100%">
                                                        </div>
                                                    </a>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                                                        <div class="friend_box">
                                                              <div style="width:100%; float:left; display:block;">
                                                                 <div class="friend_name">蔡阿文</div>
                                                                 <div class="friend_no">356位</div>
                                                              </div>
                                                              <div class="friend_text">
                                                                     <font style="font-weight:bold; color:#000000;">興趣：</font><br>
                                                                     將簡單的事件複雜化使其越作越忙！完樂台灣真有趣！啾咪...
                                                              </div>
                                                              <a href="#">
                                                                   <div class="friend_button link">取消此友</div>
                                                              </a>
                                                        </div>
                                                   </div>
                                                </div>
                                                <!--6-->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                                                    <a href="#">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  blog_animate link" style=" padding:5px; " >
                                                              <img src="images/photo2.png" width="100%">
                                                        </div>
                                                    </a>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                                                        <div class="friend_box">
                                                              <div style="width:100%; float:left; display:block;">
                                                                 <div class="friend_name">蔡阿文</div>
                                                                 <div class="friend_no">356位</div>
                                                              </div>
                                                              <div class="friend_text">
                                                                     <font style="font-weight:bold; color:#000000;">興趣：</font><br>
                                                                     將簡單的事件複雜化使其越作越忙！完樂台灣真有趣！啾咪...
                                                              </div>
                                                              <a href="#">
                                                                   <div class="friend_button link">取消此友</div>
                                                              </a>
                                                        </div>
                                                   </div>
                                                </div>
                                        </div>    
                                        <!--朋友list end-->
    <div id="m_hight" class="col-lg-7 col-md-7 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr"   style=" padding:10px; ">
       
        
    </div>
    
    
    
    <!-- <div style="position:relative;">   
        <div id="sidebar3" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.right_menu')
        </div>
    </div> -->
@endsection