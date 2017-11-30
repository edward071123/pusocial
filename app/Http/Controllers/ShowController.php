<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Posts;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller{

	public function show(Request $reques, $id){
        $get_post = DB::table('posts')
            ->select('posts.*','users.id as uid','users.puid','users.name','users.avatar',DB::raw('COUNT(thumbs.id) as count'))
        ->where('posts.id','=',$id)
        ->leftJoin('users', 'users.id', '=', 'posts.author_id' )
        ->leftJoin('thumbs', 'thumbs.on_post', '=', 'posts.id')
        ->get();
        
        $result = (array) json_decode(json_encode($get_post[0]));
        //  var_dump(Auth::check());
        //     die();
        if(Auth::check()){
            $self_user = Auth::user();
            $friend_status = 1;
            if($result['author_id'] != $self_user->id){
                $stament = "SELECT * FROM friend 
                            WHERE ((`from` = ".$result['author_id']." AND `to` = ".$self_user->id." )
                                OR (`to` = ".$result['author_id']." AND `from` = ".$self_user->id." )) AND `check` =1";
                $friend = DB::select($stament);
                if(count($friend) == 0)
                    $friend_status = 0;
            }
            $commercials = DB::table('commercial')
            ->where('start_date','<=',date("Y-m-d"))
            ->where('end_date','>=',date("Y-m-d"))
            ->where('loginpg','=',1)
            ->orderBy('id','desc')
            ->get();
            // var_dump($friend_status);
            // die();
            return view('showotherpost')->with(array("commercials" => $commercials,"posts"=>$get_post,"friend"=>$friend_status));
        }else{
            $commercials = DB::table('commercial')
            ->where('start_date','<=',date("Y-m-d"))
            ->where('end_date','>=',date("Y-m-d"))
            ->where('unloginpg','=',1)
            ->orderBy('id','desc')
            ->get();
            return view('show')->with(array("commercials" => $commercials,"post"=>$get_post[0]));
        }
		
	}
}
