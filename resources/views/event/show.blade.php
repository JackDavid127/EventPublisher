@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    活动信息
                </div>

                <div class="panel-body">
                    <h3>{{ $event->event_title }}</h3>
                    <p>标签：
                        @foreach ($tags as $tag)
                        <a href="/tag/{{ $tag }}"><span class="label label-success">#{{ $tag }}</span></a>
                        @endforeach
                    </p>
                    <dl class="dl-horizontal">
                        <dt>发起人</dt><dd><a href="/user/{{ $user->id }}">{{ $user->name }}</a></dd>
                        <dt>活动地点</dt><dd><?php echo $event->event_place; ?></dd>
                        <dt>活动开始时间</dt><dd><?php echo $event->event_start; ?></dd>
                        <dt>活动结束时间</dt><dd><?php echo $event->event_end; ?></dd>
                        <dt>报名截止时间</dt><dd><?php echo $event->event_opentill; ?></dd>
                        <dt>剩余名额</dt><dd><?php echo $event->event_total; ?></dd>
                    </dl>
                    <h4 class="page-header">活动介绍</h4>
                    <p><?php echo $event->event_content; ?></p>
                    <h4 class="page-header">活动要求</h4>
                    <p><?php echo $event->event_limit; ?></p>
                    <h4 class="page-header">已参与的用户</h4>
                    @if ($isadmin == true)
                    <table class="table table-striped table-bordered table-hover">
                        <tr><td>Id</td><td>昵称</td><td>真实姓名</td><td>手机号码</td><td>电子邮箱地址</td></tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a href='/user/{{ $user->id }}'>{{ $user->name }}</a></td>
                                <td>{{ $user->truename }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                    <h3>
                        @foreach ($users as $user)
                            <a href="/user/{{ $user->id }}"><span class="label label-primary">{{ $user->name }}</span></a>
                        @endforeach
                    </h3>
                    @endif
                    <br /><br />
                    @if ($isadmin == true)
                        <form action="/event/<?php echo $event->event_id; ?>" method="POST">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <a class="btn btn-success" href="/event/<?php echo $event->event_id; ?>/edit" role="button">编辑活动</a>
                            <button type="submit" class="btn btn-danger">删除活动</button>
                        </form>
                    @elseif ($isin == true)
                        <a class="btn btn-danger" href="/event/<?php echo $event->event_id; ?>/cancel" role="button">退出活动</a>
                    @elseif ($isok == true)
                        <form action="/event/<?php echo $event->event_id; ?>/signup" class="form-horizontal" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group">
                                <label for="message" class="col-sm-2 control-label">备注</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="message" name="message" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">参加活动</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <p>该活动已截止报名或没有报名名额。</p>
                        <a class="btn btn-success disabled" href="#" role="button">参加活动</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
