@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">编辑活动</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/event/<?php echo $event->event_id ?>">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label for="event_title" class="col-sm-2 control-label">活动标题</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_title" value="<?php echo $event->event_title ?>" name="event_title" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_tags" class="col-sm-2 control-label">活动分类标签</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_tags" value="{{ $tagsval }}" name="event_tags" placeholder="请将不同标签用空格隔开"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_content" class="col-sm-2 control-label">活动介绍</label>
                            <div class="col-sm-10">
                                <textarea required class="form-control" rows="5" id="event_content" value="<?php echo $event->event_content ?>" name="event_content"><?php echo $event->event_content; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_limit" class="col-sm-2 control-label">活动要求</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="event_limit" value="<?php echo $event->event_limit ?>" name="event_limit"><?php echo $event->event_limit; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_total" class="col-sm-2 control-label">活动人数限制</label>
                            <div class="col-sm-10">
                                <input required type="number" min="0" class="form-control" id="event_total" value="<?php echo $event->event_total ?>" name="event_total" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_start" class="col-sm-2 control-label">活动开始时间</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_start" value="<?php echo $event->event_start ?>" name="event_start" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_end" class="col-sm-2 control-label">活动结束时间</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_end" value="<?php echo $event->event_end ?>" name="event_end" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_place" class="col-sm-2 control-label">活动地点</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_place" value="<?php echo $event->event_place ?>" name="event_place" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_opentill" class="col-sm-2 control-label">活动报名截止时间</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_opentill" value="<?php echo $event->event_opentill ?>" name="event_opentill" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
