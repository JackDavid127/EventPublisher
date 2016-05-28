@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">好友列表</div>
                <div class="panel-body">
                    <h4 class="page-header">好友</h4>
                    <table class="table table-striped table-hover">
                        <tr><td>昵称</td><td>操作</td></tr>
                        @foreach ($friends as $user)
                            <tr>
                                <td><a href="/user/{{ $user->id }}">{{ $user->name }}</a></td>
                                <td>
                                    <form action="/user/{{ $user->id }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <a class="btn btn-primary" href="/user/{{ $user->id }}/edit" role="button">发送消息</a>
                                        <button type="submit" class="btn btn-danger">删除好友</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <h4 class="page-header">申请待通过好友</h4>
                    <table class="table table-striped table-hover">
                        <tr><td>昵称</td><td>操作</td></tr>
                        @foreach ($pfriends as $user)
                            <tr><td><a href="/user/{{ $user->id }}">{{ $user->name }}</a></td><td>
                                <form action="/user/{{ $user->id }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <a class="btn btn-success" href="/user/{{ $user->id }}/edit" role="button">通过好友请求</a>
                                    <button type="submit" class="btn btn-danger">拒绝好友请求</button>
                                </form>
                            </td></tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
