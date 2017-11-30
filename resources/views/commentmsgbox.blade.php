 <div class="f_msg_body" id="commit_{{$post->id}}" style="display:none">                            
                            <div class="f_msg_top">
                                <span style="float:left; margin-right:8px;"><img src="{{ asset('images/icon32.png') }}" width="30" height="26"></span> 
                            </div><!--f_msg_top end--> 
                            <!--留言框--> 
                            <div class="f_msg_box">
                                <a href="#">
                                    <div class=" people_pic3 link">
                                    @if(empty(Auth::user()->avatar))
                                        <img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%">
                                    @else
                                        <img src="{{ url('/uploads/avatars/'.Auth::user()->avatar)}}" width="100%">
                                    @endif
                                    </div>
                                </a>
                                 <div class="people_msg_topbox">
                                <span class="people_msgli">{{Auth::user()->name}}</span>
                            </div>
                                <form class="send_comment" enctype="multipart/form-data"  method="POST">
                                <div class="f_msg_bg">
                                    <input class="msg_input form-control textarea-control" name="post_comment" id="post_comment_body_{{$post->id}}" type="text" class="f_msg1" placeholder="留言..." data-emojiable="true" data-emoji-input="unicode"></div>
                                <!--留言menu-->
                                <div class="msg_foot">
                                    <div class="msg_icon_li">
                                     <div class="msg_icon_up" style="top:8px;"><img src="{{ asset('images/icon25.png') }}" width="29" height="29"></div>
                                         <input type="file" name="comment_avatar" class="comment_avatar"  style="opacity: 0; width:45px; overflow:hidden; height:45px;">
                                    </div>
                                    <div class="msg_icon_li2">
                                        <a href="javascript:void(0);">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="post_id" value="{{$post->id}}">
                                            <input type="submit" value="送出" class="people_left_top3 link">
                                        </a>  
                                    </div><!--msg_icon_li2 end-->                            
                                </div>
                            </form>
                            </div><!--f_msg_box end--> 
                            <div class="f_msg_box2" id="comment_list_{{$post->id}}">
                            </div>
                        </div><!--f_msg_body end--> 