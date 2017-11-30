<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Chat;
use App\Posts;
use App\Comments;
use App\User;
use File;
class Swoole extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
        protected $signature = 'swoole {action?}';
        
            /**
            * The console command description.
            *
            * @var string
            */
            protected $description = 'swoole';
     
        /**
        * Create a new command instance.
        *
        * @return void
        */
        public function __construct(){
             parent::__construct();
        }
     
        /**
        * Execute the console command.
        *
        * @return mixed
        */
        public function handle(){
            $action = $this->argument('action');
            switch ($action) {
                case 'close':
                    break;
                default:
                    $this->start();
                    break;
            }
        }
         public function start(){
            //创建websocket服务器对象，監聽0.0.0.0:9503端口
            $ws = new \swoole_websocket_server("0.0.0.0", 9504, SWOOLE_PROCESS, SWOOLE_SOCK_TCP | SWOOLE_SSL);
            $key_dir = "/etc/letsencrypt/live/edwardspeedforce.com";
            $ws->set(array(
                'daemonize' => 1,
                'task_worker_num' => 10,
                'ssl_cert_file' => $key_dir.'/fullchain.pem',
                'ssl_key_file' => $key_dir.'/privkey.pem',
            ));

            $ws->on('finish', function ($ws, $task_id, $data) {
            });
            //監聽WebSocket連接打開事件
            $ws->on('open', function ($ws, $request) {
                echo "server: handshake success with fd{$request->fd}\n";
                //  var_dump(Auth::check());
                //  die();
                // if (Auth::check()) {
                   
                // }else{
                //     $ws->close($request->fd);
                // }
                 // var_dump($request->fd, $request->get, $request->server);
                 //$ws->push($request->fd, "client-{$request->fd} hello, welcome\n");
             });
             
             $ws->on('task', function ($ws, $task_id, $from_id, $data) {
                
            });

             //監聽WebSocket消息事件
             $ws->on('message', function ($ws, $frame) {
                    $data = json_decode( $frame->data , true );

                    switch($data['type']){
                        case 1://登入
                            $input['uid'] = (int)$data['uid'];
                            $input['fd'] = $frame->fd;
                            Chat::create( $input );
                            $msg = array(
                                'type' => $data['type'],
                                'uid' => $data['uid'],
                            );
                            foreach ($ws->connections as $fd) {
                                $ws->push($fd, json_encode($msg));
                            }
                            break;
                        case 2: //新消息
                            $chaters = Chat::select('fd')->where('uid', $data['to_uid'])->get()->toArray();                      
                            DB::table('message')->insert(
                                ['from' => $data['from_uid'], 'to' =>$data['to_uid'], 'message' =>$data['msg']]
                            );
                            $msg = array(
                                'type' => $data['type'],
                                'msg' => $data['msg'],
                                'from_uid'=>$data['from_uid'],
                                'to_uid'=>$data['to_uid']
                            );
                            foreach ($chaters as $chater) {
                                $ws->push($chater['fd'], json_encode($msg));
                            }
                            $ws->push($frame->fd, json_encode($msg));
                            break;
                        case 4: //歷史資料
                            // $chater_from = Chat::select('uid')->where('fd', $data['from_fd'])->get()->toArray();
                            // $data['from_uid']= $chater_from[0]['uid'];

                            // var_dump($chater);
                            // die();
                            $type = 4;
                            $m_counts =  DB::table('message')->where(function ($query) use ($data){
                                $query->where('from', '=', $data['self_uid'])
                                    ->where('to', '=', $data['from_uid']);
                            })->orWhere(function($query) use ($data){
                                $query->where('from', '=', $data['from_uid'])
                                    ->where('to', '=', $data['self_uid']);	
                            })->count();
                            $messages =  DB::table('message')->where(function ($query) use ($data){
                                $query->where('from', '=', $data['self_uid'])
                                    ->where('to', '=', $data['from_uid']);
                            })->orWhere(function($query) use ($data){
                                $query->where('from', '=', $data['from_uid'])
                                    ->where('to', '=', $data['self_uid']);	
                            })->orderBy('created_at','desc')->skip($data['last_mid'])->take(5)->get()->toArray();
                            $msg = array(
                                'type' => $type,
                                'messages'=>$messages,
                                'm_counts'=>$m_counts,
                                'from_uid'=>$data['from_uid'],
                                'last_mid'=>$data['last_mid'],
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        // case 5: //po新動態
                        //     $input['author_id'] = $data['from_uid'];
                        //     $input['body'] = $data['post'];
                        //     $input['area'] = $data['area'];
                        //     $input['active'] = 1;
                        //     Posts::create( $input );
                        //     $user = User::find($data['from_uid']);
                        //     $msg = array(
                        //         'type' => $data['type'],
                        //         'msg' => $data['post'],
                        //         'area' => $data['area'],
                        //         'name' => $user->name,
                        //         'avatar' => $user->avatar,
                        //     );
                        //     foreach ($ws->connections as $fd) {
                        //         $ws->push($fd, json_encode($msg));
                        //     } 
                        // break;
                        case 6: //po留言
                            $comments = Comments::select('users.name', 'users.avatar','comments.*')->where('on_post', '=', $data['post_id'])->leftJoin('users', 'users.id', '=', 'comments.from_user')->get()->toArray();
                            // var_dump($comments);
                            // die();
                            $msg = array(
                                'type' => $data['type'],
                                'comments' => $comments,
                                'post_id' =>  $data['post_id']
                            );
                            foreach ($ws->connections as $fd) {
                                $ws->push($frame->fd, json_encode($msg));
                            } 
                        break;
                        case 7: //po新動態
                            if($request->hasFile('avatar') ){
                                $avatar = $request->file('avatar');
                                $get_type = $avatar->getClientOriginalExtension();
                                
                                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
                                $input['pic'] = $filename;
                            }
                            $input['from_user'] = $data['from_uid'];
                            $input['on_post'] = $data['post_id'];
                            $input['body'] = $data['post'];
                            
                            Comments::create( $input );
                            $user = User::find($data['from_uid']);
                            $msg = array(
                                'type' => $data['type'],
                                'post_id' => $data['post_id'],
                                'msg' => $data['post'],
                                'name' => $user->name,
                                'avatar' => $user->avatar,
                            );
                            foreach ($ws->connections as $fd) {
                                $ws->push($fd, json_encode($msg));
                            } 
                        break;
                        case 8: //全部聊天過的人
                            // $messages_from = Message::select(DB::raw('u1.id,u1.name,u1.avatar,max(message.created_at) as xx'))
                            // ->where('message.from', '=', $data['from_uid'])
                            // ->leftJoin('users as u1', 'u1.id', '=', 'message.to')
                            // ->groupby('message.to','message.from')
                            // ->orderBy('xx','desc');
                           
                            // $messages_all = Message::select(DB::raw('u2.id,u2.name,u2.avatar,max(message.created_at) as xx'))
                            // ->where('message.to', '=', $data['from_uid'])
                            // ->leftJoin('users as u2', 'u2.id', '=', 'message.from')
                            // ->groupby('message.from')
                            // ->orderBy('xx','desc')
                            // ->union($messages_from)->orderBy('xx','desc')->get()->toArray();

                            $stament = "SELECT * FROM (
                                            (
                                                SELECT u1.id AS uid, u1.name, u1.avatar, MAX( m1.created_at ) AS time
                                                FROM message AS m1
                                                LEFT JOIN users AS u1 ON u1.id = m1.to
                                                WHERE m1.from =".$data['from_uid']."
                                                GROUP BY m1.to
                                                ORDER BY time DESC
                                            )
                                            UNION 
                                            (
                                                SELECT u1.id AS uid, u1.name, u1.avatar, MAX( m2.created_at ) AS time
                                                FROM message AS m2
                                                LEFT JOIN users AS u1 ON u1.id = m2.from
                                                WHERE m2.to =".$data['from_uid']."
                                                GROUP BY m2.from
                                                ORDER BY time DESC
                                            )   ORDER BY time DESC) x
                                            GROUP BY x.uid
                                            ORDER BY x.time DESC";

                            $messages_all = DB::select($stament);
                                               
                            $msg = array(
                                'type' => $data['type'],
                                'from_uid' => $data['from_uid'],
                                'user' => $messages_all
                            );
                            $ws->push($frame->fd, json_encode($msg));
                            // foreach ($ws->connections as $fd) {
                            //     $ws->push($fd, json_encode($msg));
                            // } 
                        break;
                        case 9: //加好友
                            $message = "交友已送出";
                            $stament = "SELECT * FROM friend 
                                        WHERE ((`from` = ".$data['from_uid']." AND `to` = ".$data['to_uid']." )
                                            OR (`to` = ".$data['from_uid']." AND `from` = ".$data['to_uid']." ))";
                            $friend = DB::select($stament);
                            if(count($friend) == 0){
                                 DB::table('friend')->insert(
                                    ['from' => $data['from_uid'], 'to' =>$data['to_uid']]
                                );
                            }else{
                                $result = (array) json_decode(json_encode($friend[0]));
                                if($result['check'] == 1)
                                    $message = "已經是好友";
                                else {
                                    $message = "對方審核中";
                                }
                            }
                           
                            $msg = array(
                                'type' => $data['type'],
                                'from_uid' => $data['from_uid'],
                                'message' => $message
                            );

                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 10: //加好刪除好友邀請
                            DB::table('friend')->where('id', '=', $data['friend_id'])->delete();
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 11: //答應加入好友
                            DB::table('friend')->where('id', $data['friend_id'])->update(['check' => 1]);
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 12: //新增興趣
                            $get_contents = explode(',',$data['content']);
                            //var_dump($data['content']);
                            foreach($get_contents as $get_content){
                                // $get_id = explode('-',$get_content)[0];
                                // $get_name = explode('-',$get_content)[1];
                                $interest = DB::table('interest_use')->where('user_id', '=', $data['from_uid'])->where('interest_name', '=', $get_content)->first();
                                if(empty($interest)){
                                    $id = DB::table('interest_use')->insertGetId(
                                        ['user_id' => $data['from_uid'], 'interest_name' =>$get_content]
                                    );
                                    $msg = array(
                                        'type' => $data['type'],
                                        'from_uid' => $data['from_uid'],
                                        'id' => $id,
                                        'content'=>$get_content
                                    );
                                    $ws->push($frame->fd, json_encode($msg));
                                }
                            }
                        break;
                        case 13: //新增相簿
                            $id = DB::table('album')->insertGetId(
                                ['user_id' => $data['from_uid'], 'title' =>$data['title']]
                            );
                            // $albumpath = public_path().'/uploads/album/' . $id;
                            // if (!(File::exists($albumpath))){
                            //     File::makeDirectory($albumpath, $mode = 0777, true, true);
                            // }
                            $msg = array(
                                'type' => $data['type'],
                                'from_uid' => $data['from_uid'],
                                'album_id' => $id,
                                'title'=>$data['title']
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 14: //投票
                            $get_date = date("Y-m-d");
                            $get_vote = DB::table('vote')->where('from', $data['from'])->where('date', 'like', '%'.$get_date.'%')->get()->toArray();
                            if(count($get_vote) == 0){
                                DB::table('vote')->insert(
                                    ['from' => $data['from'], 'to' =>$data['to']]
                                );
                                $msg = array(
                                    'type' => $data['type'],
                                    'to_uid' => $data['to'],
                                    'result' => "success"
                                );
                            }else{
                                $msg = array(
                                    'type' => $data['type'],
                                    'to_uid' => $data['to'],
                                    'result' => "already voted"
                                );
                            }
                            $ws->push($frame->fd, json_encode($msg));
                            // foreach ($ws->connections as $fd) {
                            //     $ws->push($fd, json_encode($msg));
                            // } 
                        break;
                        case 15: //掌聲
                            $get_thumb = DB::table('thumbs')->where('on_post', $data['to'])->where('from_user', $data['from'])->get()->toArray();
                            if(count($get_thumb) == 0){
                                DB::table('thumbs')->insert(
                                    ['from_user' => $data['from'], 'on_post' =>$data['to']]
                                );
                                $msg = array(
                                    'type' => $data['type'],
                                    'to_pid' => $data['to'],
                                    'result' => "success"
                                );
                            }else{
                                $msg = array(
                                    'type' => $data['type'],
                                    'to_pid' => $data['to'],
                                    'result' => "already thumb"
                                );
                            }
                            $ws->push($frame->fd, json_encode($msg));
                            // foreach ($ws->connections as $fd) {
                            //     $ws->push($fd, json_encode($msg));
                            // } 
                        break;
                        case 16: //興趣的隱私
                            DB::table('interest_use')->where('id', $data['inter'])->update(['permission' => $data['permission']]);
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 17: //刪除興趣
                            DB::table('interest_use')->where('id', '=', $data['inter'])->delete();
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 18: //興趣比對
                            // $user_interests = DB::table('interest_use')
                            // ->select('interest_use.*','users.id','users.name','users.avatar','interest.name as iname')
                            // ->whereIn('interest_use.interest_id',explode(',',$data['content']))
                            // ->where('interest_use.user_id','<>',$data['from_uid'])
                            // ->leftJoin('users', 'users.id', '=', 'interest_use.user_id' )
                            // ->leftJoin('interest', 'interest.id', '=', 'interest_use.interest_id')
                            // ->orderBy('interest_use.id', 'desc')
                            // ->get()->toArray();
                            $user_interests = DB::table('interest_use')
                            ->select('interest_use.*','users.id','users.puid','users.name','users.avatar')
                            ->whereIn('interest_use.interest_name',explode(',',$data['content']))
                            ->where('interest_use.user_id','<>',$data['from_uid'])
                            ->where('i2.permission','<>',1)
                            ->leftJoin('interest_use as i2', 'i2.id', '=', 'interest_use.id' )
                            ->leftJoin('users', 'users.id', '=', 'interest_use.user_id' )
                            ->orderBy('interest_use.id', 'desc')
                            ->get()->toArray();
                            
                            // var_dump($user_interests);
                            // die();
                            $msg = array(
                                'type' => $data['type'],
                                'interest_arrays' => $user_interests,
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 19: //修改照片說明
                            DB::table('photo')->where('id', $data['photo_id'])->update(['content' => $data['content']]);
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 20: //刪除照片
                            $get_photo = DB::table('photo')->where('id', $data['photo_id'])->get()->toArray();
                            unlink(public_path('uploads/album/'.$get_photo[0]->album_id.'/'.$get_photo[0]->photo_path));
                            DB::table('photo')->where('id', '=', $data['photo_id'])->delete();
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 21: //刪除相簿
                            $get_photos = DB::table('photo')->where('album_id', $data['albumId'])->get()->toArray();
                            foreach($get_photos as $get_photo){
                                unlink(public_path('uploads/album/'.$get_photo->album_id.'/'.$get_photo->photo_path));
                                DB::table('photo')->where('id', '=', $get_photo->id)->delete();
                            }
                            DB::table('album')->where('id', '=', $data['albumId'])->delete();
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 22: //分享貼文
                            $get_post = DB::table('posts')
                            ->select('posts.*','u1.name')
                            ->where('posts.id','=',$data['postId'])
                            ->leftJoin('users as u1', 'u1.id', '=', 'posts.author_id' )
                            ->get()->toArray();
                            $result = (array) json_decode(json_encode($get_post[0]));
                             DB::table('posts')->insert(
                                [
                                    'share_from' => $result['author_id'], 
                                    'author_id' =>$data['from_uid'],
                                    'body' =>"分享於<a href='".url('/pusocial/userpage/'.$result['author_id'])."'>".$result['name']."</a>的動態<br>".$result['body'], 
                                    'area' =>$result['area'], 
                                    'pic' =>$result['pic'], 
                                    'active'=>1,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ]
                            );
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                                'post_id' => $data['postId'],
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 23: //檢舉貼文
                            $get_post = DB::table('report')
                            ->where('post_id','=',$data['postId'])
                            ->where('user_id','=',$data['from_uid'])
                            ->get()->toArray();
                            $result = (array) json_decode(json_encode($get_post));
                            $messege = "已檢舉過了";
                            if(count($result) == 0){
                                 DB::table('report')->insert(
                                    [
                                        'post_id' => $data['postId'], 
                                        'user_id' =>$data['from_uid']
                                    ]
                                );
                                $messege = "檢舉成功";
                            }
                           
                            $msg = array(
                                'type' => $data['type'],
                                'message' => $messege,
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        case 24: //變更動態權限
                            DB::table('posts')->where('id', $data['postId'])->update(['active' => $data['active']]);
                            $msg = array(
                                'type' => $data['type'],
                                'message' => "success",
                            );
                            $ws->push($frame->fd, json_encode($msg));
                        break;
                        default :
                            $ws->push($frame->fd, json_encode(array('code'=>0,'msg'=>'type error')));
                    }
                echo "client-{$frame->fd}Message: {$frame->data}\n";

                 //$ws->push("1", "server: {$frame->data}");
                 //$ws->task(['msg' => $frame->data, 'cu_fd' => $frame->fd]);
             });
     
             //監聽WebSocket連接關閉事件
             $ws->on('close', function ($ws, $fd) {
                $user = Chat::select('uid')->where('fd', $fd)->get()->toArray();
                $get_uid = $user[0]['uid'];
                //刪除離線
                Chat::where("fd" , '=', $fd)->delete();
                //搜尋該帳號是否還有其他連線
                $other_chats = Chat::select('id')->where('uid', $get_uid)->count();
                if($other_chats == 0){
                    $msg = array(
                        'type' => 3,
                        'uid' => $get_uid
                    );
                    foreach ($ws->connections as $connect_fd) {
                        $ws->push($connect_fd, json_encode($msg));  
                    }
                }
                echo "client-{$fd} is closed\n";
             });
     
             $ws->start();
         }
}
