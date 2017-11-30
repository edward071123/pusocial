<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>人脈People Connection</title>
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('css/camera.css') }}" rel="stylesheet">
		<link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
		<link href="{{ asset('css/owl.transitions.css') }}" rel="stylesheet">
		<link href="{{ asset('css/jquery.custom-scrollbar.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/swiper.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/emoji.css') }}" rel="stylesheet">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
    
	<body class="animated  fadeIn bg">
		<div class="wide_layout relative w_xs_auto">
			<header role="banner" class="type_5" style=" font-size:16px;">
				<section class="h_bot_part">
					<div class="menu_wrap">
						<div class="container">
							<div class="clearfix row">
								
								<div class="mobile_logo"><a href="{{ url('/home') }}"><img src="{{ asset('images/logo.png') }}"></a></div>
								
								
								<button id="menu_button" class="r_corners centered_db d_none tr_all_hover d_xs_block m_xs_bottom_5">
									<span class="centered_db r_corners"></span>
									<span class="centered_db r_corners"></span>
									<span class="centered_db r_corners"></span>
								</button>
                                
								<div class="col-lg-12 clearfix t_sm_align_c">
									<div class="clearfix t_sm_align_l f_left f_sm_none relative s_form_wrap m_sm_bottom_15 p_xs_hr_0 m_xs_bottom_5 mobile_menu1" style="margin-top:15px;">
										
									
										<nav role="navigation" class="f_left f_xs_none d_xs_none m_sm_right_0" style=" width:100%;    margin-bottom: 2px;">	
											<div style=" float:left;">
												<li class="relative f_xs_none  m_left_10 m_xs_left_0 logo_right for_pc" style=" text-align:center; float:left; ">
													<a href="#" style="background-color: #e6002d;"><span class="say_logo"><img src="{{ asset('images/logo.png') }}"></span></a>	
												</li>
											</div>                                              									
											<ul class="horizontal_list main_menu type_2 clearfix mobile_top1 menu_right">																			
												<li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style=" text-align:center; ">
													<a href="{{ url('/register') }}" class="tr_delay_hover color_dark tt_uppercase r_corners" style="border-radius: 0px;" >
													<b  class="menu_c link">加入人脈</b></a>
												</li>
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</div>
					</div>    
				</section>
			</header>
		</div>
		<div class="container">
			<div class="row">
					 <!--中間-->
    <div id="m_hight" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr"   style=" padding:10px; ">
        <div class="list_past_msg">
						
								@yield('content')
                                
                                </div>
                                </div>
                                
                                    <!--右側廣告-->
    
       <!--右側廣告 end-->
						
					</div>
				</div>
		</div>
		<div class="popup_wrap d_none" id="login_popup">
			<section class="popup r_corners shadow">
				<button class="bg_tr color_grey color_dark tr_all_hover text_cs_hover close f_size_large"><i class="fa fa-times"></i></button>
				<figure class="t_align_c">
                    <img src="images/registered.png" alt="" width="80%" />
                    <figcaption>
                        <h2 class="m_bottom_10 color_red color_dark t_align_c">註冊</h2>
                        <div class="m_bottom_20 color_grey t_align_c">即刻加入掌握人脈!</div>
                    </figcaption>
              </figure>
			  <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        		{{ csrf_field() }}
					<ul>
						<li class="m_bottom_15">
							<label for="username" class="m_bottom_5 d_inline_b">E-mail：</label>
							<input type="text" id="email" name="email" class="r_corners full_width">
						</li>
						<li class="m_bottom_15">
							<label for="password" class="m_bottom_5 d_inline_b">密碼：</label>
							<input type="password" name="" id="password" name="password"  class="r_corners full_width">
						</li>
                        <li class="m_bottom_15">
							<label for="password" class="m_bottom_5 d_inline_b">密碼確認：</label>
							<input type="password" name="password_confirmation" id="password-confirm" class="r_corners full_width">
						</li>
                       <!--  <li class="m_bottom_15">
							<label for="username" class="m_bottom_5 d_inline_b">驗證碼：</label>
							<div class="m_bottom_20 m_sm_bottom_10"><input type="text" name="" id="code" class="r_corners full_width" style="width:60%;">
                            <span class="f_right"><img src="images/code_pic.png" /></span></div>
						</li>  -->
                        
						
						<li class="clearfix m_bottom_30">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 t_align_c" style="padding-right:5px;">
                                <button class="unlogin_red_button_1 button_type_4 tr_all_hover r_corners f_left bg_scheme_color color_light f_mxs_none m_bottom_5 m_mxs_bottom_15 color_dark">立即加入</button>
                            </div>
						</li>
					</ul>
			  </form>
			</section>
		</div>
		<!-- Scripts -->
		<script src="{{ asset('js/jquery-2.1.4.js') }}"></script>
		<script src="{{ asset('js/bootstrap3.2.0.min.js') }}"></script>
		<script src="{{ asset('js/commentForm.js') }}"></script>
		<script src="{{ asset('js/modernizr.js') }}"></script>
		<script src="{{ asset('js/wow.min.js') }}"></script>
		<script src="{{ asset('js/jquery.tweet.min.js') }}"></script>
		 <script src="{{ asset('js/ini.js') }}"></script>
		<script src="{{ asset('js/retina.js') }}"></script>
		<script src="{{ asset('js/camera.min.js') }}"></script>
		<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
		<script src="{{ asset('js/waypoints.min.js') }}"></script>
		<script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
		<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('js/scripts.js') }}"></script>
	</body>
</html>