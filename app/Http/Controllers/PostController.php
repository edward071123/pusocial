<?php

namespace App\Http\Controllers;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Posts;
use App\Comments;
use App\User;
use Image;
use Auth;
class PostController extends Controller{
    /**
    *
    * @return void
    */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        //fetch 5 posts from database which are active and latest
        $self_user = Auth::user();
        $voter = DB::table('users')
        ->select('users.id','users.puid','users.name','users.avatar',DB::raw('COUNT(vote.to) as votecount'))
        ->leftJoin('vote', 'vote.to', '=', 'users.id')
        ->groupBy('users.id')
        ->orderBy('votecount','desc')
        ->take(5)
        ->get();

        $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('loginpg','=',1)
        ->orderBy('id','desc')
        ->get();


        $posts = DB::table('posts')
        ->select('posts.*','users.id as uid','users.puid','users.name','users.avatar',DB::raw('COUNT(thumbs.id) as count'))
        ->where('posts.active','>',1)
        ->leftJoin('thumbs', 'thumbs.on_post', '=', 'posts.id')
        ->leftJoin('users', 'users.id', '=', 'posts.author_id')
        ->groupBy('posts.id')
        ->orderBy('posts.created_at','desc')
        ->get();
        //page heading
        $users = DB::table('users')
        ->select('users.id','users.name','users.avatar',DB::raw('COUNT(chat.uid) as online'))
        ->leftJoin('chat', 'chat.uid', '=', 'users.id')
        ->groupBy('users.id')
        ->get();

        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();

          $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$self_user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();

        $friends = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        //$users = User::orderBy('created_at','desc');
        //return home.blade.php template from resources/views folder
        return view('home')->with(array("commercials" => $commercials,"users" => $users, "posts" => $posts,"voters" => $voter,"friends"=>$friends,"albums"=>$albums,"u_interests" => $user_interests));
       // return view('home')->with(array("users" => $users, "posts" => $posts,"voters" => $voter,"files"=>$files ));
    }
    public function mypage(Request $request){
        $user = $request->user();
        $self_user = Auth::user();
        //fetch 5 posts from database which are active and latest
        $posts = DB::table('posts')
        ->select('posts.*','users.id as uid','users.name','users.avatar',DB::raw('COUNT(thumbs.id) as count'))
        ->where('posts.active','<>',0)->where('author_id',$self_user->id)
        ->leftJoin('thumbs', 'thumbs.on_post', '=', 'posts.id')
        ->leftJoin('users', 'users.id', '=', 'posts.author_id')
        ->groupBy('posts.id')
        ->orderBy('posts.created_at','desc')
        ->get();
        $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('loginpg','=',1)
        ->orderBy('id','desc')
        ->get();
         $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$self_user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        //$posts = Posts::where('active',1)->where('author_id',$self_user->id)->orderBy('created_at','desc')->get();
        //page heading
        $users = DB::table('users')
        ->select('users.id','users.name','users.avatar',DB::raw('COUNT(chat.uid) as online'))
        ->leftJoin('chat', 'chat.uid', '=', 'users.id')
        ->groupBy('users.id')
        ->get();
        $friends = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
        //$users = User::orderBy('created_at','desc');
        //return home.blade.php template from resources/views folder
        return view('mypage')->with(array("commercials" => $commercials,"users" => $users, "posts" => $posts,"friends"=>$friends,"albums"=>$albums,"u_interests" => $user_interests));
    }

    public function userpage(Request $request,$id){
        //用puid取得userid
        $get_usesr = DB::table('users')
        ->where('puid',$id)->get();
        $user = $get_usesr[0];
        $uid = $user->id;
        if(Auth::user()->id == $uid ){
            return redirect()->route('mypage');
        }
        
        //與對方的交友關係1:好友,0:非好友
        $friend_status = 1;
        $stament = "SELECT * FROM friend 
                            WHERE ((`from` = ".$uid ." AND `to` = ".Auth::user()->id." )
                                OR (`to` = ".$uid ." AND `from` = ".Auth::user()->id." )) AND `check` =1";
        $friend = DB::select($stament);
        if(count($friend) == 0)
            $friend_status = 0;

        $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('loginpg','=',1)
        ->orderBy('id','desc')
        ->get();

        $posts = DB::table('posts')
        ->select('posts.*','users.id as uid','users.puid','users.name','users.avatar',DB::raw('COUNT(thumbs.id) as count'))
        ->where('posts.active','>',0)->where('author_id',$uid)
        ->leftJoin('thumbs', 'thumbs.on_post', '=', 'posts.id')
        ->leftJoin('users', 'users.id', '=', 'posts.author_id')
        ->groupBy('posts.id')
        ->orderBy('posts.created_at','desc')
        ->get();

        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$uid)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        
        $friends = DB::table('friend')
        ->where(function ($query) use ($uid){
            $query->where('from', $uid)
                ->orWhere('to', $uid);
        })->where('check', 1)->count();

        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$uid)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();

        return view('user')->with(array("commercials" => $commercials,"fstatus"=>$friend_status,"albums"=>$albums,"user" => $user, "posts" => $posts,"friends"=>$friends,"u_interests" => $user_interests));
    }
    public function myfriend(Request $request){
        $self_user = Auth::user();

        $friends = DB::table('friend')
        ->select('friend.*','u1.name as u1name','u1.puid as u1puid','u1.avatar  as u1avatar','u2.puid as u2puid','u2.name as u2name','u2.avatar   as u2avatar')
        ->leftJoin('users as u1', 'u1.id', '=', 'friend.from')
        ->leftJoin('users as u2', 'u2.id', '=', 'friend.to')
        ->where('friend.from','=', $self_user ->id)
        ->orWhere('friend.to','=', $self_user ->id)
        ->get();

        $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('friendpg','=',1)
        ->orderBy('id','desc')
        ->get();
        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=', $self_user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
        $friends_count = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        return view('myfriend')->with(array( "commercials" => $commercials,"myfriends"=> $friends,"friends" => $friends_count,"albums"=>$albums,"u_interests" => $user_interests));
    }
    public function dosearch(Request $request){
        $user = $request->user();
        $self_user = Auth::user();
        $get_input = $request->input('search_input');
        $friends = DB::table('users')
        ->select('puid','name','avatar')
        ->where('puid','=',$get_input)
        ->orWhere('name','like','%'.$get_input.'%')
        ->get();
        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
        $friends_count = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        return view('search')->with(array("myfriends"=> $friends,"friends" => $friends_count,"user"=>$user,"albums"=>$albums,"u_interests" => $user_interests));
    }
    public function searchview(Request $request){
        $user = $request->user();
        $self_user = Auth::user();
        $request->input('post_id');
        $friends = array();
          $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
        $friends_count = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        //$users = User::orderBy('created_at','desc');
        //return home.blade.php template from resources/views folder
        return view('search')->with(array("myfriends"=> $friends,"friends" => $friends_count,"user"=>$user,"albums"=>$albums,"u_interests" => $user_interests));
    }
    public function friend(Request $request,$id){
        //用puid取得userid
        $get_usesr = DB::table('users')
        ->where('puid',$id)->get();
        $user = $get_usesr[0];
        $uid = $user->id;

        $friends = DB::table('friend')
        ->select('friend.*','u1.name as u1name','u1.puid as u1puid','u1.avatar  as u1avatar','u2.puid as u2puid','u2.name as u2name','u2.avatar   as u2avatar')
        ->leftJoin('users as u1', 'u1.id', '=', 'friend.from')
        ->leftJoin('users as u2', 'u2.id', '=', 'friend.to')
        ->where('friend.check','=','1')
        ->where('friend.from','=',$uid)
        ->orWhere('friend.to','=',$uid)
        ->get();

        $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('friendpg','=',1)
        ->orderBy('id','desc')
        ->get();

        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$uid)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$uid)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
        $friends_count = DB::table('friend')
        ->where(function ($query) use ($uid){
            $query->where('from', $uid)
                ->orWhere('to', $uid);
        })->where('check', 1)->count();

        return view('friend')->with(array("commercials" => $commercials,"myfriends"=> $friends,"friends" => $friends_count,"user"=>$user,"albums"=>$albums,"u_interests" => $user_interests));
    }
    public function userfriend(Request $request){
        $user = $request->user();
        //fetch 5 posts from database which are active and latest
        $posts = Posts::where('active',1)->where('author_id',$user->id)->orderBy('created_at','desc')->get();
        //page heading
        $users = DB::table('users')
        ->select('users.id','users.name','users.avatar',DB::raw('COUNT(chat.uid) as online'))
        ->leftJoin('chat', 'chat.uid', '=', 'users.id')
        ->groupBy('users.id')
        ->get();

        //$users = User::orderBy('created_at','desc');
        //return home.blade.php template from resources/views folder
        return view('userfriend')->with(array("user" => $users[0], "posts" => $posts));
    }

    public function myinterest(Request $request){
        $user = $request->user();
        $self_user = Auth::user();

        // $choice_interests = DB::table('interest')
        // ->select('interest.*')
        // ->orderBy('interest.id', 'desc')
        // ->get();


        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$self_user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('interestpg','=',1)
        ->orderBy('id','desc')
        ->get();

        
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();

        $friends = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        //$users = User::orderBy('created_at','desc');
        //return home.blade.php template from resources/views folder
        return view('myinterest')->with(array("commercials" => $commercials,"u_interests" => $user_interests,"user"=>$user,"friends"=>$friends,"albums"=>$albums));
    }

    public function interestcompare(Request $request){
        $user = $request->user();
        $self_user = Auth::user();
         $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('interestpg','=',1)
        ->orderBy('id','desc')
        ->get();
        // $choice_interests = DB::table('interest')
        // ->select('interest.*')
        // ->orderBy('interest.id', 'desc')
        // ->get();

       $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$self_user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();

        // $user_interests = DB::table('interest_use')
        // ->select('interest_use.*','interest.name','interest.id as int_id')
        // ->where('interest_use.user_id','=',$user ->id)
        // ->leftJoin('interest', 'interest.id', '=', 'interest_use.interest_id')
        // ->orderBy('interest_use.id', 'desc')
        // ->get();

        
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();

        $friends = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();

        return view('interest')->with(array("commercials" => $commercials,"u_interests" => $user_interests,"user"=>$user,"friends"=>$friends,"albums"=>$albums));
    }
    public function myalbum(Request $request){
        $self_user = Auth::user();
        $user = $request->user();
        //fetch 5 posts from database which are active and latest
        //page heading
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$self_user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
         $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('albumpg','=',1)
        ->orderBy('id','desc')
        ->get();

        $aalbums = DB::table('album')
        ->select('album.*',DB::raw('COUNT(photo.id) as photocount'))
        ->where('album.user_id','=',$self_user->id)
        ->leftJoin('photo', 'photo.album_id', '=', 'album.id')
        ->groupBy('album.id')
        ->orderBy('id', 'desc')
        ->get();
       $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$self_user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        $friends = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        //$users = User::orderBy('created_at','desc');
        //return home.blade.php template from resources/views folder
        return view('myalbum')->with(array( "commercials" => $commercials,"aalbums" => $aalbums,"albums" => $albums,"user"=>$user,"friends"=>$friends,"u_interests" => $user_interests));
    }
    public function album(Request $request,$id){
        //用puid取得userid
        $get_usesr = DB::table('users')
        ->where('puid',$id)->get();
        $user = $get_usesr[0];
        $uid = $user->id;

        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$uid)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();

         $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('albumpg','=',1)
        ->orderBy('id','desc')
        ->get();

        $aalbums = DB::table('album')
        ->select('album.*',DB::raw('COUNT(photo.id) as photocount'))
        ->where('album.user_id','=',$uid)
        ->leftJoin('photo', 'photo.album_id', '=', 'album.id')
        ->groupBy('album.id')
        ->orderBy('id', 'desc')
        ->get();
        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$uid)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        
        $friends = DB::table('friend')
        ->where(function ($query) use ($uid){
            $query->where('from', $uid)
                ->orWhere('to', $uid);
        })->where('check', 1)->count();

        return view('album')->with(array("commercials" => $commercials,"aalbums" => $aalbums,"albums" => $albums,"user"=>$user,"friends"=>$friends,"u_interests" => $user_interests));
    }
    public function albumphoto(Request $request,$userid,$id){

        //用puid取得userid
        $get_usesr = DB::table('users')
        ->where('puid',$userid)->get();
        $user = $get_usesr[0];
        $uid = $user->id;
        // var_dump($user);
        // die();
        $leftalbums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$uid)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();

         $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('albumpg','=',1)
        ->orderBy('id','desc')
        ->get();
        $albums = DB::table('album')->where('id',$id)->get();
        $albumpath = public_path().'/uploads/album/' . $id;
        if (!(File::exists($albumpath))){
			File::makeDirectory($albumpath, $mode = 0777, true, true);
        }
        
        $photos = DB::table('photo')
        ->select('photo.*')
        ->where('photo.album_id','=',$id)
        ->orderBy('photo.id', 'desc')
        ->get();
        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$uid)
        ->orderBy('interest_use.id', 'desc')
        ->get();
        
        $friends = DB::table('friend')
        ->where(function ($query) use ($uid){
            $query->where('from', $uid)
                ->orWhere('to', $uid);
        })->where('check', 1)->count();


        return view('albumphoto')->with(array("commercials" => $commercials,"user"=>$user,"photos" => $photos,"albums" => $leftalbums,"album" => $albums[0],"friends"=>$friends,"u_interests" => $user_interests));
    }
    public function myalbumphoto(Request $request,$id){
        //fetch 5 posts from database which are active and latest
        $self_user = Auth::user();
        $leftalbums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
         $commercials = DB::table('commercial')
        ->where('start_date','<=',date("Y-m-d"))
        ->where('end_date','>=',date("Y-m-d"))
        ->where('albumpg','=',1)
        ->orderBy('id','desc')
        ->get();
        $albums = DB::table('album')->where('id',$id)->get();
        $albumpath = public_path().'/uploads/album/' . $id;
        if (!(File::exists($albumpath))){
			File::makeDirectory($albumpath, $mode = 0777, true, true);
        }
        $photos = DB::table('photo')
        ->select('photo.*')
        ->where('photo.album_id','=',$id)
        ->orderBy('photo.id', 'desc')
        ->get();
        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$self_user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();

        $friends = DB::table('friend')
        ->where(function ($query) use ($self_user){
            $query->where('from', $self_user->id)
                ->orWhere('to', $self_user->id);
        })->where('check', 1)->count();
        //$users = User::orderBy('created_at','desc');
        //return home.blade.php template from resources/views folder
        return view('myalbumphoto')->with(array("commercials" => $commercials,"photos" => $photos,"albums" => $leftalbums,"album" => $albums[0],"friends"=>$friends,"u_interests" => $user_interests));
    }

    public function mypoll(Request $request){
        $user = $request->user();

        $voter = DB::table('users')
        ->select('users.id','users.name','users.avatar',DB::raw('COUNT(vote.to) as votecount'))
        ->where('users.id', '<>', $user->id)->leftJoin('vote', 'vote.to', '=', 'users.id')
        ->groupBy('users.id')
        ->orderBy('votecount','desc')
        ->get();
        $user_interests = DB::table('interest_use')
        ->select('interest_use.*')
        ->where('interest_use.user_id','=',$user ->id)
        ->orderBy('interest_use.id', 'desc')
        ->get();

        $friends = DB::table('friend')
        ->where(function ($query) use ($user){
            $query->where('from', $user->id)
                ->orWhere('to', $user->id);
        })->where('check', 1)->count();
        $albums = DB::table('album')
        ->select('album.*')
        ->where('album.user_id','=',$user->id)
        ->orderBy('id', 'desc')
        ->take(6)
        ->get();
        return view('poll')->with(array("voters" => $voter,"user"=>$user,"u_interests" => $user_interests,"friends"=>$friends,"albums"=>$albums));
    }
    public function create(Request $request){
        // if user can post i.e. user is admin or author
        if($request->user()->can_post()){
            return view('create');
        }else {
            return redirect('/')->withErrors('You have not sufficient permissions for writing post');
        }
    }

    //public function store(PostFormRequest $request)
    public function store(Request $request){
        $this->validate($request, [
            // 'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'publish_at' => 'nullable|date',
        ]);
        $post = new Posts();
        // $post->title = $request->get('title');
        $post->body = $request->get('body');
        //$post->slug = str_slug($post->title);
        $post->author_id = $request->user()->id;
        if($request->has('save')){
            $post->active = 0;
            $message = 'Post saved successfully';            
        }else {
            $post->active = 1;
            $message = 'Post published successfully';
        }
        $post->save();
        return redirect('edit/'.$post->slug)->withMessage($message);
    }

    public function edit(Request $request,$slug){
        $post = Posts::where('slug',$slug)->first();
        if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
            return view('edit')->with('post',$post);
        return redirect('/')->withErrors('you have not sufficient permissions');
    }
    public function update(Request $request){
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())){
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Posts::where('slug',$slug)->first();
            if($duplicate){
                if($duplicate->id != $post_id){
                    return redirect('edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
                }else {
                    $post->slug = $slug;
                }
            }
            $post->title = $title;
            $post->body = $request->input('body');
            if($request->has('save')){
                $post->active = 0;
                $message = 'Post saved successfully';
                $landing = 'edit/'.$post->slug;
            }else {
                $post->active = 1;
                $message = 'Post updated successfully';
                $landing = $post->slug;
            }
            $post->save();
            return redirect($landing)->withMessage($message);
        }else{
            return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }
    public function destroy(Request $request, $id){
        $post = Posts::find($id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())){
            $post->delete();
            $data['message'] = 'Post deleted Successfully';
        }else {
            $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        return redirect('/')->with($data);
    }

    public function send_post(Request $request){
        $user = Auth::user();
        $message = '發布動態成功';
        if(!empty($request->input('post_body'))){
            if($request->hasFile('avatar') ){
                $avatar = $request->file('avatar');
                $get_type = $avatar->getClientOriginalExtension();
                if($get_type == 'png' || $get_type == 'PNG' || $get_type == 'jpeg' || $get_type == 'jpg' || $get_type == 'JPG'){
                    $filename = time() . '.' . $avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/posts/' . $filename ) );
                    $input['pic'] = $filename;
                }else{
                    $message = '請上傳 png jpg 圖檔';
                }
            }
            $input['author_id'] = $user->id;
            $input['body'] = str_replace("\n","<br />", $request->input('post_body'));
            $input['area'] = $request->input('post_area');
            $input['active'] = $request->input('active');
            Posts::create( $input );
        }else{
            $message = "請輸入內容";
        }
         return array("message" => $message);
    }
    public function send_comment(Request $request){
        $user = Auth::user();
        $message = '留言成功';
        if(!empty($request->input('post_comment'))){
            if($request->hasFile('comment_avatar') ){
                $avatar = $request->file('comment_avatar');
                $get_type = $avatar->getClientOriginalExtension();
                if($get_type == 'png' || $get_type == 'PNG' || $get_type == 'jpeg' || $get_type == 'jpg' || $get_type == 'JPG'){
                    $filename = time() . '.' . $avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/posts/' . $filename ) );
                    $input['pic'] = $filename;
                }else{
                    $message = '請上傳 png jpg 圖檔';
                }
            }
            $input['from_user'] = $user->id;
            $input['on_post'] = $request->input('post_id');
            $input['body'] = str_replace("\n","<br />", $request->input('post_comment'));
            Comments::create( $input );
        }else{
            $message = "請輸入內容";
        }
       
        return array("message" => $message,"post_id" => $request->input('post_id'));
    }
}

        //fetch 5 posts from database which are active and latest
        //$posts = Posts::where('active',1)->where('author_id',$id)->orderBy('created_at','desc')->get();
        //page heading
        // $users = DB::table('users')
        // ->select('users.id','users.name','users.avatar',DB::raw('COUNT(chat.uid) as online'))
        // ->leftJoin('chat', 'chat.uid', '=', 'users.id')
        // ->groupBy('users.id')
        // ->get();