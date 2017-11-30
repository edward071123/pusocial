@extends('layouts.not_login_app')
@section('content')
     <div style="width:100%; max-width:460px; margin-right:auto; margin-left:auto;">
	<figure class="t_align_c">
        <img src="images/registered.png" alt="" width="80%" />
        <figcaption>
            <h2 class="m_bottom_10 color_red color_dark t_align_c">註冊</h2>
            <div class="m_bottom_20 color_grey t_align_c">即刻加入掌握人脈!</div>
        </figcaption>
    </figure>
    <ul>

    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
         <li class="m_bottom_15">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="username" class="m_bottom_5 d_inline_b">名稱：</label>
                <input type="text" id="name" name="name" class="r_corners full_width" value="{{ old('name') }}" required autofocus>
                 @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </li>
        <li class="m_bottom_15">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="username" class="m_bottom_5 d_inline_b">E-mail帳號：</label>
                <input type="text" id="email" name="email" class="r_corners full_width" value="{{ old('email') }}" required autofocus>
                 @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </li>
        <li class="m_bottom_35">
             <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="m_bottom_5 d_inline_b">密碼：</label>
                <input type="password" name="password" id="password" class="r_corners full_width" required>
                 @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </li>
        <li class="m_bottom_35">
             <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="m_bottom_5 d_inline_b">密碼：</label>
                <input type="password" name="password_confirmation"  class="r_corners full_width" required>
            </div>
        </li>
        
         <!-- <li class="m_bottom_35">
             <div class="form-group">
                <label for="introducer" class="m_bottom_5 d_inline_b">介紹人：</label>
               
                <input type="text" name="introducer" value="" class="r_corners full_width" placeholder="請輸入介紹人ID號碼" >
            </div>
        </li> -->
    

        <!--<div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>
        </div>-->
        <li class="clearfix m_bottom_30">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 t_align_c" style="padding-right:5px;">
                <button type="submit" class="unlogin_red_button_1 button_type_4 tr_all_hover r_corners f_left bg_scheme_color color_light f_mxs_none m_bottom_5 m_mxs_bottom_15 color_dark" style="min-width: 100%;">立即註冊</button>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 t_align_c" style="margin-top:25px;">
                <a href="{{ url('/login') }}" class="unlogin_red_button_1 button_type_4 tr_all_hover r_corners f_left bg_scheme_color color_light f_mxs_none m_bottom_5 m_mxs_bottom_15 color_dark" style="min-width: 100%;">
                返回登入頁面!!
                 </a>
            </div>
        </li>
    </form>
    </ul>
</div>
@endsection
