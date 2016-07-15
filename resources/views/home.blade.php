<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <form action="{{ url('/article') }}" method="POST">
            {!! csrf_field() !!}
            <textarea name="content" rows="10" class="form-control" required="required" placeholder="请输入留言内容"></textarea>
            <br>
            <button class="btn btn-lg btn-info">新增留言</button>
        </form>
    </div>
</div>

 <!-- JavaScripts -->
<script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
