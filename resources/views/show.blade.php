@extends('layouts.not_login_app')

@section('content')
     <div style="width:100%; max-width:460px; margin-right:auto; margin-left:auto;">
        <div class="list_past_msg">
                <div class="msg_box">
                @if($post->active == 3)
                    <div class="people_msg_top">
                        <a href="{{ url('/userpage/'.$post->uid) }}">
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
                        <img src="{{ url('/uploads/posts/'.$post->pic)}}" width="100%">
                    </div>
                @else 
                    此動態無對外開放
                @endif
                </div>
        </div>
</div>
@include('commercial')
@endsection
