@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    活动列表
                    <a class="btn btn-success" href="{{ url('/event/create')}}" role="button">添加活动</a>
                </div>

                <div class="panel-body">
                    <h3 class="page-header">所有活动</h3>
                    <table class="table table-bordered table-hover table-striped">
                        <tr><td>Id</td><td>活动标题</td><td>活动报名截止时间</td></tr>
                        <?php
                            foreach ($events as $event){
                                echo "<tr><td>".$event->event_id."</td><td><a href=/event/".$event->event_id.">".$event->event_title."</a></td><td>".$event->event_opentill."</td></tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
