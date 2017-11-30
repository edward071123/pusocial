<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Auth;
use Image;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Posts;
class UserController extends Controller{

	/**
    *
    * @return void
    */
    public function __construct(){
        $this->middleware('auth');
    }
	/*
	* Display active posts of a particular user
	* 
	* @param int $id
	* @return view
	*/
	public function user_posts($id){
		$posts = Posts::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
		$title = User::find($id)->name;
		return view('home')->withPosts($posts)->withTitle($title);
	}
	/*
	* Display all of the posts of a particular user
	* 
	* @param Request $request
	* @return view
	*/
	public function user_posts_all(Request $request){
		$user = $request->user();
		$posts = Posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
		$title = $user->name;
		return view('home')->withPosts($posts)->withTitle($title);
	}
	/*
	* Display draft posts of a currently active user
	* 
	* @param Request $request
	* @return view
	*/
	public function user_posts_draft(Request $request){
		$user = $request->user();
		$posts = Posts::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
		$title = $user->name;
		return view('home')->withPosts($posts)->withTitle($title);
	}
	/**
	* profile for user
	*/
	public function profile(Request $request, $id) {
		$get_user = DB::table('users')
		->select('users.*','vote.id as vid','u2.puid as u2puid')
		->where('users.id','=',$id)
		->leftJoin('vote', 'vote.from', '=', 'users.id')
		->leftJoin('users as u2', 'u2.id', '=', 'vote.to')
		->get()->toArray();
		if (!$get_user[0])
			return redirect('/');
		$result = (array) json_decode(json_encode($get_user[0]));
		$data['user'] = $result;
		// if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
		// 	$data['author'] = true;
		// } else{
		// 	$data['author'] = null;
		// }
		// $data['comments_count'] = $data['user'] -> comments -> count();
		// $data['posts_count'] = $data['user'] -> posts -> count();
		// $data['posts_active_count'] = $data['user'] -> posts -> where('active', '1') -> count();
		// $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
		// $data['latest_posts'] = $data['user'] -> posts -> where('active', '1') -> take(5);
		// $data['latest_comments'] = $data['user'] -> comments -> take(5);
		
		// $users = DB::table('users')
        // ->select('users.id','users.name','users.avatar','users.lan',DB::raw('COUNT(chat.uid) as online'))
        // ->leftJoin('chat', 'chat.uid', '=', 'users.id')
        // ->groupBy('users.id')
		// ->get();
		// $users = DB::table('users')
        // ->select('users.id','users.name','users.avatar','users.lan','vote.id as vid')
        // ->leftJoin('vote', 'vote.uid', '=', 'users.id')
        // ->groupBy('users.id')
		// ->get();
		// var_dump($users );
		// die();
		return view('profile')->with(array("data"=> $data));
		//return view('profile', $data);
	}
	/**
	* profile for user
	*/
	public function update_avatar(Request $request) {
		// var_dump(implode("/",$request->input('lan')));
		// die();
		// Handle the user upload of avatar
		$user = Auth::user();
		$message = '修改成功';
		if($request->hasFile('avatar') ){
			$avatar = $request->file('avatar');
			$get_type = $avatar->getClientOriginalExtension();
			
			if($get_type == 'png' || $get_type == 'PNG' || $get_type == 'jpeg' || $get_type == 'jpg' || $get_type == 'JPG'){
				$filename = time() . '.' . $avatar->getClientOriginalExtension();
				Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
				$user->avatar = $filename;
			}else{
				$message = '請上傳 png jpg 圖檔';
			}
		}
		if($request->hasFile('my_page_banner') ){
			$avatar = $request->file('my_page_banner');
			$get_type = $avatar->getClientOriginalExtension();
			if($get_type == 'png' || $get_type == 'PNG' || $get_type == 'jpeg' || $get_type == 'jpg' || $get_type == 'JPG'){
				$filename = time() . '.' . $avatar->getClientOriginalExtension();
				Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/banners/' . $filename ) );
				$user->banner = $filename;
			}else{
				$message = '請上傳 png jpg 圖檔';
			}
		}
		if(!empty($request->input('introducer'))){
			$get_user = DB::table('users')->select('users.id')->where('puid', $request->input('introducer'))->get()->toArray();
			if(count($get_user) == 0){
				$message = '無此介紹人ID';
			}else{
				$result = (array) json_decode(json_encode($get_user[0]));
				DB::table('vote')->insert(
					['from' => $user->id, 'to' =>$result['id']]
				);
			}
		}
		$user->name = $request->input('user_name');
		$user->live = $request->input('country');
		$user->my_title = $request->input('myTitle');
		$user->sex = $request->input('sex');
		$user->birthday = $request->input('birthday');
		$user->edu = $request->input('edu');
		$user->mobile = $request->input('mobile');
		$user->job = $request->input('job');
		$user->lan = implode("/",$request->input('lan'));
		$user->save();

		// var_dump($user);
		// die();
		return redirect('user/'.$user->id)->withMessage($message);
	}
	public function addphoto(Request $request) {
		// Handle the user upload of avatar
		$user = Auth::user();
		$message = '請先選擇檔案';
		$albumpath = public_path().'/uploads/album/' . $request->albumid;
		if (!(File::exists($albumpath))){
			File::makeDirectory($albumpath, $mode = 0777, true, true);
		}
		$i=0;
		foreach ($request->photos as $photo) {
			// $filename = $photo->store('photos');
			// Image::make($photo)->resize(300, 300)->save( public_path('/uploads/test/' . $filename ) );
			$image = $photo;
			$filename  = time() . $i.'.' . $image->getClientOriginalExtension();
			$path = $albumpath.'/'.$filename;
			//var_dump($filename);
			Image::make($image->getRealPath())->save($path);
			DB::table('album')->where('id', $request->albumid)->update(['cover' => $filename]);
			DB::table('photo')->insert(
				['user_id' => $user->id, 'album_id' =>$request->albumid ,'photo_path' =>$filename,'content' =>"",'create_date' =>date('Y-m-d')]
			);
			$i++;
		}
		//die();
		//$files = File::allFiles($albumpath);
		// foreach ($files as $file)
		// {
		// 	echo (string)$file, "\n";
		// }
		// var_dump($request->file('avatar'));
    	// if($request->hasFile('avatar')){
		// 	$avatar = $request->file('avatar');
		// 	$get_type = $avatar->getClientOriginalExtension();
		// 	if($get_type == 'png' || $get_type == 'PNG' || $get_type == 'jpeg' || $get_type == 'jpg' || $get_type == 'JPG'){
		// 		$filename = time() . '.' . $avatar->getClientOriginalExtension();
		// 		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
		// 		//找出原圖&delete
		// 		$message = '上傳成功';
		// 	}else{
		// 		$message = '請上傳 png jpg 圖檔';
		// 	}
		// }
		return redirect('myalbumphoto/'.$request->albumid)->withMessage($message);
	}
}
