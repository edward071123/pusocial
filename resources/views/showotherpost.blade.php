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
         var showPath = "{{ url('/show') }}";
    </script>
   <!-- <p class="visible-xs">
         <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
    </p>-->
    
    <div class="for_mobile mobile_name" >{{ Auth::user()->name }}</div>

    <div class="banner_bg">
        <div class="container" > 
            
        </div>
    </div>
  
  
      <div class="container">
 <div class="clearfix row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate " style="padding:10px;">    
    <!--左側-->
    <div style="position:relative; float:left;">   
    </div>
    <!--中間-->
    <div id="m_hight" class="col-lg-7 col-md-7 col-sm-12 col-xs-12 m_sm_bottom_35 blog_animate animate_ftr"   style=" padding:10px; ">
        <div class="list_past_msg">
            @foreach($posts as $post)
            @if($post->active == 1)
                此動態未公開
            @elseif($post->active == 2)
                @if($friend == 1)
                    @include('userpagepost')
                @else
                    此動態只限定好友
                @endif
            @else
                @include('userpagepost')
            @endif
            @endforeach
        </div>
    </div>
    
    
    
        <!--右側廣告-->
    @include('commercial')
       <!--右側廣告 end-->
    
    </div>
    </div>
    </div>
@endsection