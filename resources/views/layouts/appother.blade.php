<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>人脈People Connection</title>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('css/camera.css') }}" rel="stylesheet">
		<link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
		<link href="{{ asset('css/owl.transitions.css') }}" rel="stylesheet">
		<link href="{{ asset('css/jquery.custom-scrollbar.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/swiper.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/emoji.css') }}" rel="stylesheet">
        
        <link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet">
        <!--tag-->
        <link href="{{ asset('css/inputTags.css') }}" rel="stylesheet">
		<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
        <!--light box-->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}">
        
        <!---->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-select.css') }}">
		
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
								<div class="mobile_logo"><a href="{{ url('/home') }}"><img src="{{ url('images/logo.png')}}"></a></div>
								<!--button for responsive menu-->
								<button id="menu_button" class="r_corners centered_db d_none tr_all_hover d_xs_block m_xs_bottom_5">
									<span class="centered_db r_corners"></span>
									<span class="centered_db r_corners"></span>
									<span class="centered_db r_corners"></span>
								</button>
								<div class="col-lg-12 clearfix t_sm_align_c">
									<div class="clearfix t_sm_align_l f_left f_sm_none relative s_form_wrap m_sm_bottom_15 p_xs_hr_0 m_xs_bottom_5 mobile_menu1" style="margin-top:15px;">	
										<!--main menu-->
										<nav role="navigation" class="f_left f_xs_none d_xs_none m_sm_right_0" style=" width:100%;    margin-bottom: 2px;">	
											@include('layouts.menu')
										</nav>
									</div>
								</div><!--col-lg-12 clearfix t_sm_align_c end-->
							</div><!--clearfix row end-->
						</div><!--container end-->
				</section><!--h_bot_part end-->
			</header><!--header end-->
				<div id="main" class="page_content_offset">
					@yield('content')
				</div>
		</div><!--wide_layout relative w_xs_autou end-->
		<!-- Scripts -->
	<!--	<script src="{{ asset('js/jquery-2.1.4.js') }}"></script>
		<script src="{{ asset('js/bootstrap3.2.0.min.js') }}"></script>
		<script src="{{ asset('js/chatpopup.js') }}"></script>
		<script src="{{ asset('js/websocket.js') }}"></script>
		<script src="{{ asset('js/postForm.js') }}"></script>
		<script src="{{ asset('js/commentForm.js') }}"></script>
		<script src="{{ asset('js/modernizr.js') }}"></script>
		<script src="{{ asset('js/wow.min.js') }}"></script>
		
		<script src="{{ asset('js/ini.js') }}"></script>
		<script src="{{ asset('js/retina.js') }}"></script>
		<script src="{{ asset('js/camera.min.js') }}"></script> 
		<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
		<script src="{{ asset('js/waypoints.min.js') }}"></script>
		<script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
		<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('js/jquery.custom-scrollbar.js') }}"></script>
		<script src="{{ asset('js/config.js') }}"></script>
		<script src="{{ asset('js/util.js') }}"></script>
		<script src="{{ asset('js/jquery.emojiarea.js') }}"></script>
		<script src="{{ asset('js/emoji-picker.js') }}"></script>-->
		        <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
        <script src="{{ asset('js/retina.js') }}"></script>
        <script src="{{ asset('js/camera.min.js') }}"></script>
        <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('js/waypoints.min.js') }}"></script>
        <script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.tweet.min.js') }}"></script>
        <script src="{{ asset('js/jquery.custom-scrollbar.js') }}"></script>
           <script src="{{ asset('js/scripts.js') }}"></script>
        
        
        
     
        
		<script src="{{ asset('js/jquery-2.1.4.js') }}"></script>
     
        
        <!--light box-->
        <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
        
        <!--tag-->
        <script src="{{ asset('js/inputTags.jquery.js') }}"></script>
		<script src="{{ asset('js/bootstrap3.2.0.min.js') }}"></script>
		<script src="{{ asset('js/chatpopup.js') }}"></script>
		<script src="{{ asset('js/websocket.js') }}"></script>
		<script src="{{ asset('js/postForm.js') }}"></script>
		<script src="{{ asset('js/commentForm.js') }}"></script>
		<script src="{{ asset('js/modernizr.js') }}"></script>
		<script src="{{ asset('js/wow.min.js') }}"></script>
		
		<script src="{{ asset('js/ini.js') }}"></script>
		
		<script src="{{ asset('js/camera.min.js') }}"></script> 
		<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
		<script src="{{ asset('js/waypoints.min.js') }}"></script>
		<script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
		<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('js/jquery.custom-scrollbar.js') }}"></script>
		<script src="{{ asset('js/config.js') }}"></script>
		<script src="{{ asset('js/util.js') }}"></script>
		<script src="{{ asset('js/jquery.emojiarea.js') }}"></script>
		<script src="{{ asset('js/emoji-picker.js') }}"></script>
        
        <!--tag s-->
        <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
		
		<script>
		$(function() {
			// Initializes and creates emoji set from sprite sheet
			window.emojiPicker = new EmojiPicker({
			emojiable_selector: '[data-emojiable=true]',
			assetsPath: '../pusocial/img',
			popupButtonClasses: 'fa fa-smile-o'
			});
			// Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
			// You may want to delay this step if you have dynamically created input fields that appear later in the loading process
			// It can be called as many times as necessary; previously converted input fields will not be converted again
			window.emojiPicker.discover();
		});
    </script>
    
     <!--light box-->
        <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    
    
     <div class="youtube">
       <iframe width="100%" style="height:auto;" height="auto" src="https://www.youtube.com/embed/tWzU1sxANcc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
    </div>
    
	</body>
</html>