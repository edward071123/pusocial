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
    </script>
    <p class="visible-xs">
         <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
    </p>
    <div>
    <div class="top_banner"
       @if(empty(Auth::user()->banner))
            style="background-image:url({{ asset('images/photo_bg.png') }}); position:relative;">
        @else
            style="background-image:url({{ url('/uploads/banners/'.Auth::user()->banner)}}); position:relative;background-size: 100%;">
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
        @if ( session()->has('message') )
            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
        @endif
       <form id="send_post" enctype="multipart/form-data"  method="POST">
        <div class="msg_bg1 wow fadeInUp animated">
            <div class="msg_left">
                <a href="javascript:void(0);">
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
                <span class="people_msgli3">
                    <span style="float:left; line-height:27px; margin-right:3px;">來自</span>
                    <input name="post_area" type="text" placeholder="請輸入地區" style="float:left; width:110px; min-height:27px;    border: 1px solid #d9d9d9;">
                  <!--  <span style="float:left; line-height:27px; margin-right:3px;">動態權限</span>
                   <br>
                    <select name="active">
                        <option value="3">公開</option>
                        <option value="2">朋友</option>
                         <option value="1">自己</option>
                    </select>-->
                </span>
                 <span class="people_msgli" style="position:absolute; right:13px; top:13px;">
                 <select name="active">
                        <option value="3">公開</option>
                        <option value="2">朋友</option>
                         <option value="1">自己</option>
                    </select>
                 </span>
                
                
            </div>

            <div class="msg_right">
                <span class="msg_icon1"><img src="{{ asset('images/icon28.png') }}" width="15" height="15"></span>
                <span class="msg_text1">
                <!--<textarea name="post_body"  class="msg_input form-control textarea-control" rows="3" placeholder="發表動態" data-emojiable="true" data-emoji-input="unicode"></textarea>-->
                
             
                <div class="form-group">
               <!--  <textarea name="post_body" id="" class="textarea_editor form-control" rows="5" placeholder="發表動態..." style="width:100%;"  ></textarea>-->
                                   <!-- <textarea name="post_body" id="textarea_editor" class="OwO-textarea form-control" rows="5" placeholder="發表動態..." style="width:100%;"></textarea>-->
                           
                           <textarea name="post_body" id="textarea_editor" class="OwO-textarea form-control" rows="5" placeholder="發表動態..." style="width:100%;"></textarea>        
                    </div>
            

               <div class="OwO"></div>
                    
                </span>
            </div>

            <div class="msg_foot">
                <div class="msg_icon_li">
                <div class="msg_icon_up"><img src="{{ asset('images/icon25.png') }}" width="29" height="29"></div>
                    <input class="t_align_c" type="file" name="avatar" value="上傳圖像" style="opacity: 0; width:45px; overflow:hidden; height:45px;">
                    <!-- <a href="#">
                        <div class="msg_icon link"><img src="{{ asset('images/icon25.png') }}" width="29" height="29"></div>
                    </a>                -->
                </div>
                <div class="msg_icon_li2">
                    <a href="javascript:void(0);">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" value="送出" class="people_left_top3 link">
                        <!-- <div class="people_left_top3 link">送出</div> -->
                    </a>  
                </div>
            </div>
        </div>
        </form>
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
                            @if(empty($post->avatar))
                                <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                            @else
                                <img src="{{ url('/uploads/avatars/'.$post->avatar)}}" width="100%">
                            @endif
                            </div>
                        </a>
                        <div class="people_msg_topbox">
                            <span class="people_msgli">{{$post->name}}</span>
                            <span class="people_msgli3">來自{{$post->area}}</span>
                            <span class="people_msgli3">於{{$post->created_at}}發布</span>
                            <br>
                            <span class="people_msgli" style="position: absolute; right:0px; top:0px;">
                            <select class="change_permission" id="cp_{{$post->id}}">
                                <option value="3" @if($post->active == 3) selected @endif>公開</option>
                                <option value="2" @if($post->active == 2) selected @endif>朋友</option>
                                <option value="1" @if($post->active == 1) selected @endif>自己</option>
                            </select>
                            </span>
                        </div>
                    </div>
                    <div class="people_msg_text">
                        {!!html_entity_decode($post->body)!!}
                        <p>
                     @if(!empty($post->pic))
                        <img src="{{ url('/uploads/posts/'.$post->pic)}}" width="100%" style="display:block;">
                    @endif
                    </div>
                    <div class="msg_down_bg">
                        <div class="msg_down_bg2">
                             <a href="javascript:void(0)" id="btn_thumb_{{$post->id}}" class="thumb_click">
                                <div class="link">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center; ">
                                        <span  class="people_icon01_2"><img src="images/icon21.png" width="29" height="29"></span>
                                        <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;" id="thumb_count_{{$post->id}}">{{$post->count}}</span>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0)" id="btn_show_{{$post->id}}" class="msg_show_commit">
                                <div class="link">
                                    <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 m_sm_bottom_5 blog_animate animate_ftr "   style=" padding:10px; text-align:center;">
                                        <span  class="people_icon01_2"><img src="images/icon22.png" width="29" height="29"></span>
                                        <span  style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;">留言</span>
                                    </div>
                                </div>
                            </a>
                          <!-- <a href="#">
                                <div class="link">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center;">
                                        <span  class="people_icon01_2"><img src="images/f_icon.png" width="29" height="29"></span>
                                        <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;">檢舉</span>
                                    </div>
                                </div>
                            </a>
                            
                             <a data-fancybox data-src="#hidden-content-c" href="javascript:;" >
                                <div class="link">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center;">
                                        <span  class="people_icon01_2"><img src="images/share-icon.png" width="29" height="29"></span>
                                        <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;">分享</span>
                                    </div>
                                </div>
                            </a> -->
                            
                            <!--分享選單-->
                             <div style="display: none;" id="hidden-content-c">
                               <p style="margin-bottom:8px;">請選擇您要分享的方式?</p>
                               <a href="#" ><div class="friend_button link pro_delete_friend" id="delete_friend_21" style="width:100%;">分享到個人動態</div></a>
                               <a href="#"><div class="friend_button link pro_delete_friend" id="delete_friend_21" style="width:100%;">複製網址</div></a>
                              </div>
                             <!--分享選單end-->
                        </div>
                        <div class="msg_line"></div>
                            @include('commentmsgbox')
                    </div>
                </div>
            </div>
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