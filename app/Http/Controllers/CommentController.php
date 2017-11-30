<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Posts;
use App\Comments;

class CommentController extends Controller{
	/**
    *
    * @return void
    */
    public function __construct(){
        $this->middleware('auth');
    }
	public function store(Request $request){
		$this->validate($request, [
            'body' => 'required|unique:posts|max:255',
        ]);
		$input['from_user'] = $request->user()->id;
		$input['on_post'] = $request->input('on_post');
		$input['body'] = $request->input('body');
		$slug = $request->input('slug');
		Comments::create( $input );
		return redirect($slug)->with('message', 'Comment published');     
	}
	public function destroy(Request $request, $id){
		$comment = Comments::find($id);
		if($comment && ($comment->from_user == $request->user()->id || $request->user()->is_admin())){
			$comment->delete();
			$data['message'] = 'Comment deleted Successfully';
		}else{
			$data['errors'] = 'Invalid Operation. You have not sufficient permissions';
		}
		return redirect('/')->with($data);
	}
}
