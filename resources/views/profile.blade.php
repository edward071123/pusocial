@extends('layouts.app')
	@section('content')
     <script>
        var getName = "{{Auth::user()->name}}";
        var getUid = "{{Auth::user()->id}}";
        var avatarDefault = "{{ asset('uploads/avatars/default.jpg') }}";
        var avatarRootPath ="{{ asset('uploads/avatars').'/' }}";
        var imageRootPath = "{{ asset('images').'/' }}";
    </script>
    
     <div class="container">
               <div class="clearfix row">
	<div class="panel panel-default">
			@if(!Auth::guest() && ($data['user']['id'] == Auth::user()->id || Auth::user()->is_admin()))
               @if ( session()->has('message') )
                    <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                @endif
				 <!--內容-->
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate "   style=" padding:10px; ">
                        	
                            <section>
                            
                            <div class="people_left01"><h2 class="m_bottom_20 color_red color_dark">個人資料</h2></div>
                            <form enctype="multipart/form-data" action="{{ url('/profile') }}" method="POST">
                                <div class="clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding:20px;">
                                    <figure>
                                    	@if(empty($data['user']['avatar']))
											<img src="{{ url('/uploads/avatars/default.jpg')}}" width="100%" class="m_bottom_20">
										@else
											<img src="{{ url('/uploads/avatars/'.$data['user']['avatar'])}}" width="100%" class="m_bottom_20">
										@endif
                                    <figcaption>
                                        <div class="d_block m_bottom_10">請選擇圖片上傳，圖片大小不得超過2MB。<font class="d_block" style="font-weight:bold;">※ 建議尺寸：500x500</font></div>
										<input class="login_pic_upload t_align_c" type="file" name="avatar" value="上傳圖像" style="width:100%;">
                                    </figcaption>
                                    </figure>
                                    
                                    
                                    <div style="width: 100%;display: block;margin-top: 25px;">
                                        @if(empty($data['user']['banner']))
											 <img src="{{ url('/images/photo_bg.png')}}" width="100%" class="m_bottom_10">
										@else
											<img src="{{ url('/uploads/banners/'.$data['user']['banner'])}}" width="100%" class="m_bottom_10">
										@endif
                                       
                                    </div>
                                    <figcaption>
                                        <div class="d_block m_bottom_10"><font class="d_block" style="font-weight:bold;">※個人首頁封面: 建議尺寸：1920x450</font></div>
										<input class="login_pic_upload t_align_c" type="file" name="my_page_banner" value="上傳圖像" style="width:100%;">
                                    </figcaption>
                                </div>
                                
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 f_right f_sm_left" style="padding:20px;">
                                    
                                    <table width="100%" border="0">
                                        <tr>
											<td>
												<div class="m_bottom_10 clearfix">
												<div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
													<label for="username" class="m_bottom_5 d_inline_b">姓名：</label>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-12">
													<input type="text" name="user_name" id="user_name" class="r_corners full_width" value="{{$data['user']['name']}}">
												</div>
												</div>
											</td>
                                        </tr>
                                        <tr>
											<td>
												<div class="m_bottom_5 clearfix">
												<div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
													<label for="username" class="m_bottom_5 d_inline_b">性別：</label>
												</div>
												<div class="col-lg-7 col-md-7 col-sm-12">
                                                   <!-- <input name="sex" type="radio" value="0" @if($data['user']['sex'] == '0') checked @endif><span style="height:35px; line-height:35px; padding-left:10px;">未提供</span>-->
													<input name="sex" type="radio" value="1" @if($data['user']['sex'] == '1') checked @endif><span style="height:35px; line-height:35px; padding-left:10px;">男性</span>
													<input name="sex" type="radio" value="2" @if($data['user']['sex'] == '2') checked @endif><span style="height:35px; line-height:35px; padding-left:10px;">女性</span>
												</div>
												</div>
											</td>
                                        </tr>
                                        <tr>
											<td>
												<div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="username" class="m_bottom_5 d_inline_b">所在地：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <select id="country" name="country">
                                                            <option value="台灣"  @if($data['user']['live'] == "台灣")  selected @endif>台灣</option>
                                                            <option value="日本" @if($data['user']['live'] == "日本")  selected @endif>日本</option>
                                                            <option value="韓國" @if($data['user']['live'] == "韓國")  selected @endif>韓國</option>
                                                            <option value="香港" @if($data['user']['live'] == "香港")  selected @endif>香港</option>
                                                            <option value="中國" @if($data['user']['live'] == "中國")  selected @endif>中國</option>
                                                        </select>
                                                    </div>
												</div>
											</td>
                                        </tr>
                                        <tr>
											<td>
												<div class="m_bottom_5 clearfix">
													<div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
														<label for="username" class="m_bottom_5 d_inline_b">ID：</label>
													</div>
													<div class="col-lg-7 col-md-7 col-sm-12"><span style="height:35px; line-height:35px;">{{$data['user']['puid']}}</span></div>
												</div>
											</td>
                                        </tr>
                                        <!--<tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="username" class="m_bottom_5 d_inline_b">給大眾捜尋的興趣：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                         <div style="display:inline-block;">
                                                            <input name="" type="checkbox" value=""  style="width:15px; height:15px; float:left;"/><span class="in_p">看電影</span>
                                                        </div>
                                                        
                                                         <div style="display:inline-block;">
                                                            <input name="" type="checkbox" value=""  style="width:15px; height:15px; float:left;"/><span class="in_p">聽音樂</span>
                                                        </div>
                                                        
                                                         <div style="display:inline-block;">
                                                            <input name="" type="checkbox" value=""  style="width:15px; height:15px; float:left;"/><span class="in_p">唱歌</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>-->
                                        
                                            <tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="myTitle" class="m_bottom_5 d_inline_b">個人首頁標題：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <input name="myTitle" type="text" class="r_corners full_width" value="{{$data['user']['my_title']}}" maxlength="15" placeholder="請輸入個人首頁文字標題" >
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="username" class="m_bottom_5 d_inline_b">生日：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <input type="text" name="birthday" id="datepicker" readonly value="{{$data['user']['birthday']}}" class="r_corners full_width" placeholder="1980-01-01">
                                                    </div>
                                                </div>
                                                <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
                                                    <script src="{{ asset('js/jquery-ui.js') }}"></script>
                                                <script type="text/javascript">
                                                    $( "#datepicker" ).datepicker({ yearRange: "1930:2100",changeYear: true,changeMonth: true,dateFormat: 'yy-mm-dd'});
                                                </script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="job" class="m_bottom_5 d_inline_b">工作：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <input type="text" name="job" value="{{$data['user']['job']}}" class="r_corners full_width">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="edu" class="m_bottom_5 d_inline_b">學校科系：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <input type="text" name="edu" value="{{$data['user']['edu']}}" class="r_corners full_width" >
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                          <tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="mobile" class="m_bottom_5 d_inline_b">電話：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <input name="mobile" type="text" value="{{$data['user']['mobile']}}" style="width:100%;" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                         
                                        <tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="introducer" class="m_bottom_5 d_inline_b">介紹人ID：</label>
                                                    </div>
                                                    @if(empty($data['user']['vid']))
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <input name="introducer" type="text" class="r_corners full_width"  maxlength="15" placeholder="請輸入介紹人ID" >
                                                    </div>
                                                    @else
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <input name="introducer" type="text" value="{{$data['user']['u2puid']}}" class="r_corners full_width"  maxlength="15" placeholder="請輸入介紹人ID" readonly>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="m_bottom_5 clearfix">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 t_align_r t_sm_align_l">
                                                        <label for="username" class="m_bottom_5 d_inline_b">語言：</label>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                                        <div style="display:inline-block;">
                                                            @if(in_array('中文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="中文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">中文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="中文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">中文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                            @if(in_array('英文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="英文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">英文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="英文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">英文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                            @if(in_array('日文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="日文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">日文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="日文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">日文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                              @if(in_array('韓文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="韓文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">韓文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="韓文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">韓文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                            @if(in_array('德文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="德文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">德文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="德文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">德文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                            @if(in_array('法文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="法文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">法文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="法文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">法文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                            @if(in_array('越南文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="越南文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">越南文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="越南文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">越南文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                            @if(in_array('泰文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="泰文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">泰文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="泰文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">泰文</span>
                                                            @endif
                                                        </div>
                                                        <div style="display:inline-block;">
                                                            @if(in_array('俄文', explode("/",$data['user']['lan'])))
                                                                 <input name="lan[]" type="checkbox" value="俄文" style="width:15px; height:15px; float:left;" checked><span style="float:left; padding-top:8px; margin-right:10px;">俄文</span>
                                                            @else
                                                                 <input name="lan[]" type="checkbox" value="俄文" style="width:15px; height:15px; float:left;" ><span style="float:left; padding-top:8px; margin-right:10px;">俄文</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                         <tr>
                                            <td>
                                                <div class="col-lg-6" style="float:none; margin:0 auto;">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" value="確認" class="unlogin_red_button_1 button_type_4 tr_all_hover r_corners f_left bg_scheme_color color_light f_mxs_none m_bottom_5 m_mxs_bottom_15 color_dark">
                                                  
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!--clearfix-->
                                
                            </form>
                                
                            </section>
                        
                     
                     </div>
			@endif
	</div>
    </div>
    </div>
	
	@endsection