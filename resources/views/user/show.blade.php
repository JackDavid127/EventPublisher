@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">用户信息</div>
                <div class="panel-body">
                    <h2>{{ $user->name }}</h2>
                @if ($isme == true)
                    <a class="btn btn-primary" href="/user/create" role="button">更新个人信息</a>
                @elseif ($isfrd == 3)
                    <form action="/user/{{ $user->id }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <a class="btn btn-primary" href="/user/{{ $user->id }}/edit" role="button">发送消息</a>
                        <button type="submit" class="btn btn-danger">删除好友</button>
                    </form>
                @elseif ($isfrd == 2)
                    <a class="btn btn-success disabled" href="#" role="button">请求已发送</a>
                @elseif ($isfrd == 1)
                    <form action="/user/{{ $user->id }}" method="POST">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <a class="btn btn-success" href="/user/{{ $user->id }}/edit" role="button">通过好友请求</a>
                        <button type="submit" class="btn btn-danger">拒绝好友请求</button>
                    </form>
                @else
                    <a class="btn btn-success" href="/user/{{ $user->id }}/edit" role="button">加为好友</a>
                @endif
                    <h4 class="page-header">基本信息</h4>
                    <dl>
                        @if ($isme == true)
                        <dt>真实姓名</dt>
                        <dd>{{ $user->truename }}</dd>
                        <dt>手机号码</dt>
                        <dd>{{ $user->phone }}</dd>
                        @endif
                        <dt>兴趣爱好</dt>
                        <dd>{{ $user->hobby }}</dd>
                        <dt>上次登录时间</dt>
                        <dd>{{ $user->updated_at }}</dd>
                        <dt>用户注册时间</dt>
                        <dd>{{ $user->created_at }}</dd>
                    </dl>
                    <h4 class="page-header">个性签名</h4>
                    <p>{{ $user->intro }}</p>
                    <h4 class="page-header">TA创建的活动</h4>
                    <ul>
                    @foreach ($myevents as $event)
                        <li><a href="/event/{{ $event->event_id }}">{{ $event->event_title }}</a></li>
                    @endforeach
                    </ul>
                    <h4 class="page-header">TA参加的活动</h4>
                    <ul>
                    @foreach ($parevents as $event)
                        <li><a href="/event/{{ $event->event_id }}">{{ $event->event_title }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
