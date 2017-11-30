<div style=" float:left;">
    <li class="relative f_xs_none  m_left_10 m_xs_left_0 logo_right for_pc" style=" text-align:center; float:left; ">
        <a href="{{ url('/home') }}" style="    background-color: #e6002d;"><span class="say_logo"><img src="{{ asset('images/logo.png') }}"></span></a>	
    </li>                                              
    <li class="relative f_xs_none  m_left_10 m_xs_left_0 logo_right for_pc" style=" text-align:center; float:left; ">
        <div style="width:260px; margin-top:8px; margin-left:10px;">
             <form id="send_search" action="{{ url('/search') }}" enctype="multipart/form-data"  method="POST">
                <input name="search_input" type="text" style="float:left; width:212px;" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="javascript:void(0)" onclick="$(this).closest('form').submit()">
                    <img src="{{ asset('images/icon01.png') }}" width="36" height="36" class="link" style="margin-top:3px;"/>
                </a>
             </form>
        </div>
    </li>
</div><!--div end-->                                      
<ul class="horizontal_list main_menu type_2 clearfix mobile_top1 menu_right">
    <li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style=" text-align:center; ">
        <a href="{{ url('/home') }}" class="tr_delay_hover color_dark tt_uppercase r_corners menu_line" style="border-radius: 0px; ">
        <b  class="menu_c link">首頁</b></a>
    </li>
    <!--  <li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style="text-align:center;">
        <a href="{{ url('/user/'.Auth::id()) }}" class="tr_delay_hover color_dark tt_uppercase r_corners menu_line" style="border-radius: 0px;">
        <b class="menu_c">個人動態</b></a>
    </li>-->
    <li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style="text-align:center; ">
        <a href="{{ url('/mypage') }}" class="tr_delay_hover color_dark tt_uppercase r_corners menu_line" style="border-radius: 0px; ">
        <b  class="menu_c">個人動態</b></a>
    </li>
   <!--  <li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style="text-align:center; ">
        <a href="{{ url('/poll') }}" class="tr_delay_hover color_dark tt_uppercase r_corners menu_line" style="border-radius: 0px; ">
        <b  class="menu_c">投票</b></a>
    </li>-->
    <li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style="text-align:center; ">
        <a href="{{ url('/myfriend') }}" class="tr_delay_hover color_dark tt_uppercase r_corners menu_line" style="border-radius: 0px; ">
        <b  class="menu_c">朋友</b></a>
    </li>                                              
    <li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style="text-align:center; ">
        <a href="{{ url('/interestcompare') }}" class="tr_delay_hover color_dark tt_uppercase r_corners menu_line" style="border-radius: 0px; ">
        <b  class="menu_c">興趣</b></a>
    </li>
    <li class="container3d relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" id="shopping_button" style="text-align:center; ">
            <a role="button"  class="tr_delay_hover color_dark tt_uppercase r_corners menu_line"  href="#" style="border-radius: 0px; ">
                <b  class="menu_c">聊天</b>
            </a>
            <div class="cart_menu shopping_cart top_arrow tr_all_hover r_corners" style="padding: 0px ">
                <div class="abgne_tab">
                    <ul class="tabs">
                        <li><a href="#tab_1">全部</a></li>
                        <!-- <li><a href="#tab_2">最新</a></li> -->
                    </ul>
                    <div class="tab_container">
                        <div id="tab_1" class="tab_content">
                         
                    </div>
                    <div id="tab_2" class="tab_content">
                        
                    </div>
                </div>
            </div><!--cart_menu shopping_cart end-->
    </li><!--container3d end-->
    
    
    
      <li class="relative f_xs_none  m_left_10 m_xs_left_0 pc_menu_top" style="text-align:center; ">
        <a href="{{ url('/logout') }}" class="tr_delay_hover color_dark tt_uppercase r_corners menu_line2" style="border-radius: 0px; ">
        <b  class="menu_c">登出</b></a>
    </li>
</ul><!--main_menu end-->