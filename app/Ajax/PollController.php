<?php namespace App\Http\Controllers\Ajax;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Poll;  // 用数据模型

use Redirect, Input, Auth, Log;

class PollController extends Controller {
public function store(Request $request)
{
    $poll = new Poll;

    $poll->date = Input::get('date');

    if ($poll->save()) {
        return response()->json(array(
            'status' => 1
            'msg' => 'ok',
        ));
    } else {
        return Redirect::back()->withInput()->withErrors('保存失败！');
    }
}
}