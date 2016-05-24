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
                    <h3><?php echo $event->event_title; ?></h3>
                    <dl class="dl-horizontal">
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
                    @if ($isadmin == true)
                        <a class="btn btn-success" href="/event/<?php echo $event->event_id; ?>/edit" role="button">编辑活动</a>
                        <form action="/event/<?php echo $event->event_id; ?>" method="POST">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
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
                        <a class="btn btn-danger disabled" href="#" role="button">参加活动</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
