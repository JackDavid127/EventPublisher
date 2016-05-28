@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">收件箱</div>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-bordered">
                    @foreach ($imsgs as $msg)
                    <tr><td>
                    @if ($msg->read == false)
                        <strong>
                    @endif
                        From <a href="/user/{{ $msg->from_user_id }}">{{ $msg->name }}</a>
                        <span style="text-align: right">At {{ $msg->created_at }}</span>
                        <p style="word-break: break-all; ">{{ $msg->text }}</p>
                    @if ($msg->read == false)
                        </strong>
                    @endif
                        <a class="btn btn-primary" href="/user/{{ $msg->from_user_id }}" role="button">回复</a>
                        <a class="btn btn-danger" href="/message/{{ $msg->mssg_id }}" role="button">删除</a>
                    </td></tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">已发送</div>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-bordered">
                    @foreach ($omsgs as $msg)
                    <tr><td>
                        To <a href="/user/{{ $msg->to_user_id }}">{{ $msg->name }}</a>
                        <span style="text-align: right">At {{ $msg->created_at }}</span>
                        <p style="word-break: break-all; ">{{ $msg->text }}</p>
                        <a class="btn btn-danger" href="/message/{{ $msg->mssg_id }}" role="button">删除</a>
                    </td></tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
