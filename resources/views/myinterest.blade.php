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
                       <select multiple data-role="tagsinput" id="interest_body"  data-placeholder="請輸入興趣" style="width:100%;">
                      </select>
                    
            
                    <div class="msg_foot">
                        <div class="msg_icon_li2">
                            <a href="javascript:void(0);">
                                <div class="people_left_top3 link" id="send_interest">送出</div>
                            </a>  
                        </div>
                    </div>
                    <div class="people_msg_title wow fadeInUp animated">
                        <span style="float:left; margin-right:6px;"><img src="images/icon36.png" width="56" height="56"></span>
                        <span style="float:left; margin-right:3px;">我的興趣</span>
                    </div>
                    <div class="interest_list" style="width:100%; display:block; float:left; background-color:#ffffff; padding-bottom:30px;">
                        @foreach($u_interests as $interest)
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate wow fadeInUp animated"   style=" padding:10px;  ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m_sm_bottom_10 blog_animate "   style=" padding:5px; ">
                                    <div class="friend_box">
                                        <div style="width:100%; float:left; display:block;">
                                            <!--<div class="friend_name">{{Auth::user()->name}}</div>-->
                                            <div class="friend_name">{{$interest->interest_name}}</div>
                                        </div>
                                        <div class="friend_text">
                                           <!-- <font style="font-weight:bold; color:#000000;">興趣：</font>-->
                                            
                                            <input class="inter_permission" id="inter_{{$interest->id}}_1" name="inter_{{$interest->id}}" type="radio" value="1" @if($interest->permission == 1) checked @endif><span style="height:35px; line-height:35px; padding-left:10px;">朋友搜尋權限</span><br>
                                            <input class="inter_permission" id="inter_{{$interest->id}}_2"  name="inter_{{$interest->id}}" type="radio" value="2" @if($interest->permission == 2) checked @endif><span style="height:35px; line-height:35px; padding-left:10px;">公開搜尋權限</span>
                                            
                                            <div class="myinterest_del" style="float:right;">
                                             <input class="inter_del" id="del_inter_{{$interest->id}}" type="button" value="刪除">
                                            </div>
                                            
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        @endforeach                		
                </div>
            </div>
        </div>
        
            <!--右側廣告-->
    @include('commercial')
       <!--右側廣告 end-->
        
    </div>
@endsection
