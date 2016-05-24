@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Message</div>

                <div class="panel-body">
                    活动添加成功！
                    <a class="btn btn-default" href="{{ url('/event/')}}" role="button">返回</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
