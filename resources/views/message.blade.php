<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>Laravel</title>
    <link href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container{
            margin-top: 2em;
        }
        .content{
            float: left;
        }
        .time{
            float: right;
        }
        .txt{
            border-bottom: 1px solid #2e3436;
            padding: 1em 0;
        }
        .txt:nth-child(3n){
            background-color: blue;
        }
        .txt:nth-child(3n+1){
            background-color: red;
        }
        .txt:nth-child(3n+2){
            background-color: #fff;
        }
        .pagelist{
            height: 50px;;
        }
        /*分页*/
        .pagelist{
            margin-top: 1em;
        }
        .cPageNum{
            border:1px solid #4a2f10;
            padding: 2px 5px;
            font-size: 17px;
        }
        .pageNum{
            border:1px solid #4a2f10;
            padding: 2px 5px;
            font-size: 13px;
        }
        h4{
            margin-top: 2em;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-7">
                <textarea name="content" rows="10" class="form-control" required="required" placeholder="请输入留言内容" id="content"></textarea>
                <br>
                <button class="btn btn-lg btn-info" onclick="addMessage()">新增留言</button>
        </div>
        <div class="col-md-7">
            <h4>全部留言</h4>
        </div>
        <input type="hidden" id="count" value="{{$count}}">
        <div class="col-md-7" id="all_mess">
            @foreach($messages as $message)
                <div class="col-md-12 txt">
                    <div class="content">{{$message->content}}</div>
                    <div class="time">{{$message->created_at}}</div>
                </div>
            @endforeach
        </div>
        <div class="col-md-7">
            <div class="pagelist" id="pageNav"></div>
        </div>
    </div>

    <!-- JavaScripts -->
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('/js/pagenav1.1.cn.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
        var show_num= 6
        var pn = Math.ceil($('#count').val()*1/show_num);
        $(function(){
            pageNav.pre="上一页";
            pageNav.next="下一页";
            pageNav.go(1,pn);
        });
        pageNav.cp = function(p){
            $.ajax({
                type: "POST",
                url: "/getmsg",
                data: "page="+p+"&show_num="+show_num,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    var msg =data.msg;
                    if(data.status == 1){
                        $("#all_mess").html('');
                        for(i in msg){
                            $("#all_mess").append('<div class="col-md-12 txt">'+
                                    '<div class="content">'+msg[i].content+'</div>'+
                                    '<div class="time">'+msg[i].created_at+'</div>'+
                                    '</div>');
                        }
                    }
                    //console.log(msg);
                }
            });
            pageNav.go(p,pn);
        }
        function addMessage(){
            var content = $('#content').val();
            $.ajax({
                type: "POST",
                url: "/addmsg",
                data: { content : content},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success:function(data){
                    var content = $('#content').val('');
                    var msg =data.msg;
                    if(data.status == 1){
                        $("#all_mess").prepend('<div class="col-md-12 txt">'+
                                '<div class="content">'+msg.content+'</div>'+
                                '<div class="time">'+msg.created_at+'</div>'+
                                '</div>');
                        $(".txt:last").remove();
                        //console.log(data);
                    }else{
                        alert(data.msg);
                        return false;
                    }
                }
            });
        }
    </script>
</body>
</html>









