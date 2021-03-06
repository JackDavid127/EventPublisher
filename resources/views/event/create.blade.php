@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">添加活动</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="/event">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="event_title" class="col-sm-2 control-label">活动标题</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_title" name="event_title"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_tags" class="col-sm-2 control-label">活动分类标签</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_tags" name="event_tags" placeholder="请将不同标签用空格隔开"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_content" class="col-sm-2 control-label">活动介绍</label>
                            <div class="col-sm-10">
                                <textarea required class="form-control" rows="5" id="event_content" name="event_content"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_limit" class="col-sm-2 control-label">活动要求</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="event_limit" name="event_limit"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_total" class="col-sm-2 control-label">活动人数限制</label>
                            <div class="col-sm-10">
                                <input required type="number" class="form-control" id="event_total" min="1" name="event_total"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_start" class="col-sm-2 control-label">活动开始时间</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_start" placeholder="YYYY-MM-DD HH:mm:ss" name="event_start"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_end" class="col-sm-2 control-label">活动结束时间</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_end" placeholder="YYYY-MM-DD HH:mm:ss" name="event_end"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_place" class="col-sm-2 control-label">活动地点</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_place" name="event_place"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_opentill" class="col-sm-2 control-label">活动报名截止时间</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="event_opentill" placeholder="YYYY-MM-DD HH:mm:ss" name="event_opentill"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">提交</button>
                                <button type="reset" class="btn btn-danger">清空</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.onload = function(){
    document.getElementById("event_content").value=
}
</script>
@endsection
