@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">发送消息</div>
                <div class="panel-body">
                    <p>接收人：{{ $user->name }}</p>
                    <form method="post" action="/user/{{ $user->id }}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="_method" value="PUT" />
                        <div class="form-group">
                            <label for="msg_content">发送内容（不超过120字）</label>
                            <textarea required class="form-control" rows="5" id="msg_content" name="msg_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">发送</button>
                        <a class="btn btn-default" href="/user/{{ $user->id }}" role="button">返回</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
