@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
    
    
    
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            
            
              <div style="width:100%; max-width:460px; margin-right:auto; margin-left:auto;">
	<figure class="t_align_c">
        <img src="../images/registered.png" alt="" width="80%" />
        <figcaption>
            <h2 class="m_bottom_10 color_red color_dark t_align_c">忘記密碼</h2>
            <div class="m_bottom_20 color_grey t_align_c">即刻加入掌握人脈!</div>
        </figcaption>
    </figure>
    

  
</div>
            
            
                <!--<div class="panel-heading">重寄密碼信</div>-->
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">請輸入Email帳號</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary" style="margin-left: auto;margin-right: auto;display: table;">
                                  寄送密碼
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
