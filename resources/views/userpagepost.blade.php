<div class="people_msg_bg wow fadeInUp animated">
    <div class="msg_box">
        <div class="people_msg_top">
            <a href="{{ url('/userpage/'.$post->puid) }}">
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
            </div>
        </div>
        <div class="people_msg_text">
            {!!html_entity_decode($post->body)!!}
            <p>
            @if(!empty($post->pic))
                <img src="{{ url('/uploads/posts/'.$post->pic)}}" width="100%">
            @endif
        </div>
        <div class="msg_down_bg">
            <div class="msg_down_bg2">
                    <a href="javascript:void(0)" id="btn_thumb_{{$post->id}}" class="thumb_click">
                    <div class="link">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center; ">
                            <span  class="people_icon01_2"><img src="{{ asset('images/icon21.png') }}" width="29" height="29"></span>
                            <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;" id="thumb_count_{{$post->id}}">{{$post->count}}</span>
                        </div>
                    </div>
                </a>
                <a href="javascript:void(0)" id="btn_show_{{$post->id}}" class="msg_show_commit">
                    <div class="link">
                        <div  class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m_sm_bottom_5 blog_animate animate_ftr "   style=" padding:10px; text-align:center;">
                            <span  class="people_icon01_2"><img src="{{ asset('images/icon22.png') }}" width="29" height="29"></span>
                            <span  style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;">留言</span>
                        </div>
                    </div>
                </a>
                
                 <a href="javascript:void(0)" id="report_{{$post->id}}" class="report_btn">
                    <div class="link">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center;">
                            <span  class="people_icon01_2"><img src="{{ asset('images/f_icon.png') }}" width="29" height="29"></span>
                            <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;">檢舉</span>
                        </div>
                    </div>
                </a>
                
                    <a data-fancybox data-src="#hidden-content-c-{{$post->id}}" href="javascript:;" >
                    <div class="link">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m_sm_bottom_5 blog_animate animate_ftr"   style=" padding:10px; text-align:center;">
                            <span  class="people_icon01_2"><img src="{{ asset('images/share-icon.png') }}" width="29" height="29"></span>
                            <span style="display:inline-block;  font-weight:bold; color:#636363; font-size:16px;">分享</span>
                        </div>
                    </div>
                </a>
                
                <!--分享選單-->
                    <div style="display: none;" id="hidden-content-c-{{$post->id}}">
                    <p style="margin-bottom:8px;">請選擇您要分享的方式?</p>
                    <a href="javascript:void(0)" ><div class="friend_button link  share_btn" id="share_{{$post->id}}"  style="width:100%;">分享到個人動態</div></a>
                    <input type="text" value="{{ url('/show') }}/{{$post->id}}">
                    </div>
                    <!--分享選單end-->
            </div>
            <div class="msg_line"></div>
            @include('commentmsgbox')
        </div>
    </div>
</div>