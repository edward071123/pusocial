@extends('layouts.app')
@section('content')
    <script>
        var getAuthUid = "{{Auth::user()->id}}";
        var getName = "{{ $user->name }}";
        var getUid = "{{ $user->id }}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
    </script>
    <div>
          <div class="top_banner"
       @if(empty($user->banner))
            style="background-image:url({{ asset('images/photo_bg.png') }}); position:relative;">
        @else
            style="background-image:url({{ url('/uploads/banners/'.$user->banner)}}); position:relative;">
        @endif
        <div class="my_title">{{$user->my_title}}</div>
            <div class="for_mobile mobile_people_pic"><!--<img src="{{ asset('images/photo.png') }}" width="100%">-->
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
    <div id="m_hight" class="col-lg-7 col-md-7 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr"   style=" padding:10px; ">
       
        <div class="people_msg_title wow fadeInUp animated">
            <span style="float:left; margin-right:6px;"><img src="images/icon29.png" width="56" height="56"></span>
            <span style="float:left;">動態</span>
        </div>
        <div class="list_past_msg">
            @foreach($posts as $post)
            <div class="people_msg_bg wow fadeInUp animated">
                <div class="msg_box">
                    <div class="people_msg_top">
                        <a href="#">
                            <div class=" people_pic3 link">
                            @if(empty($post->author->avatar))
                                <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                            @else
                                <img src="{{ url('/uploads/avatars/'.$post->author->avatar)}}" width="100%">
                            @endif
                            </div>
                        </a>
                        <div class="people_msg_topbox">
                            <span class="people_msgli">{{$post->author->name}}</span>
                        </div>
                    </div>
                    <div class="people_msg_text">
                        {!!html_entity_decode($post->body)!!}
                    </div>
                    <div class="msg_down_bg">
                        <div class="msg_down_bg2">
                            <a href="#">
                                <div class="link">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center; ">
                                        <span  class="people_icon01_2"><img src="images/icon21.png" width="29" height="29"></span>
                                        <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:20px;">掌聲</span>
                                        <span style=" color:#e6002d; font-size:14px; padding-top:4px; padding-left:5px; display: inline-flex;"></span>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0)" id="btn_show_{{$post->id}}" class="msg_show_commit">
                                <div class="link">
                                    <div  class="col-lg-4 col-md-4 col-sm-12 col-xs-12 m_sm_bottom_5 blog_animate animate_ftr "   style=" padding:10px; text-align:center;">
                                        <span  class="people_icon01_2"><img src="images/icon22.png" width="29" height="29"></span>
                                        <span  style="display:inline-block;  font-weight:bold; color:#636363; font-size:20px;">留言</span>
                                    </div>
                                </div>
                            </a>
                             <a href="#">
                                <div class="link">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center;">
                                        <span  class="people_icon01_2"><img src="images/f_icon.png" width="29" height="29"></span>
                                        <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:20px;">檢舉</span>
                                    </div>
                                </div>
                            </a>
                            <!-- <a href="#">
                                <div class="link">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center;">
                                        <span  class="people_icon01_2"><img src="images/icon23.png" width="29" height="29"></span>
                                        <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:20px;">分享</span>
                                    </div>
                                </div>
                            </a> -->
                        </div>
                        <div class="msg_line"></div>
                        <div class="f_msg_body" id="commit_{{$post->id}}" style="display:none">                            
                            <div class="f_msg_top">
                                <span style="float:left; margin-right:8px;"><img src="images/icon32.png" width="30" height="26"></span> 
                            </div><!--f_msg_top end--> 
                            <!--留言框-->  
                            <div class="f_msg_box">
                                <a href="#">
                                    <div class=" people_pic3 link">
                                    @if(empty($user->avatar))
                                        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                                    @else
                                        <img src="{{ url('/uploads/avatars/'.$user->avatar)}}" width="100%">
                                    @endif
                                    </div>
                                </a>
                                <div class="f_msg_bg">
                                    <input id="post_comment_body_{{$post->id}}" type="text" class="f_msg1" placeholder="留言..."></div>
                                <!--留言menu-->
                                <div class="msg_foot">
                                    <div class="msg_icon_li">
                                        <a href="#">
                                            <div class="msg_icon link"><img src="images/icon25.png" width="29" height="29"></div>
                                        </a>               
                                    </div>
                                    <div class="msg_icon_li2">
                                        <a href="javascript:post(2,{{$post->id}});">
                                            <div class="people_left_top3 link">送出</div>
                                        </a>  
                                    </div><!--msg_icon_li2 end-->                            
                                </div>
                            </div><!--f_msg_box end--> 
                            <div class="f_msg_box2" id="comment_list_{{$post->id}}">
                                <!-- <div class="people_msg_top">
                                        <a href="#">
                                            <div class=" people_pic3 link"><img src="images/photo.png" width="100%" ></div>
                                        </a>
                                    <div class="people_msg_topbox2" >
                                        <span class="people_msgli">強哥</span>
                                        <span class="people_msgli3">1小時前 回覆</span>
                                    </div>
                                    <div class="msg_text_1">
                                        最新照片顯示，大陸可能將被命名為「山東號」的001A型首艘自製航母，水線以下部分已刷上紅色底漆。
                                    </div>
                                </div> -->
                            </div>
                        </div><!--f_msg_body end--> 
                    </div>
                </div>
            </div>
            @endforeach
            
            
            
        </div>
        
        
        
        
    </div>
    
    <!-- <div style="position:relative;">   
        <div id="sidebar3" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate for_pc">
            @include('layouts.right_menu')
        </div>
    </div> -->
@endsection