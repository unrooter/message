<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Redis;

class MessageController extends Controller
{
    public function index(){
       //
        $messages = DB::table('messages')->orderBy('created_at', 'desc')->take(6)->get();
        $count = DB::table('messages')->count();
        return view('message',['messages' => $messages,'count'=>$count]);
    }
    public  function show(Request $request)
    {
         $page =$request->get('page');
         $show_num =$request->get('show_num');
         $messages = DB::table('messages')->skip(($page-1)*$show_num)->take(6)->orderBy('created_at', 'desc')->get();
         return response()->json(array('msg'=> $messages, 'status' => 1));
//        $redis =  Redis::connection();
//        $redis->set('name', 'Taylor');
//
//        $messages =$redis->get('name');
//        return response()->json(array('msg'=> $messages, 'status' => 1));

    }

    public function store (Request $request){
        $message = new Message;
        $msg['content']=$message->content = $request->get('content');
        $msg['created_at']=$message->created_at = date('Y-m-d H:i:s');
        if($msg['content']){
            if ($message->save()) {
                return response()->json(array('msg'=> $msg, 'status' => 1));
            } else {
                return response()->json(array('msg'=> '新增失败', 'status' => 0));
            }
        }else{
            return response()->json(array('msg'=> '请填写留言内容', 'status' => 0));
        }



    }
}
