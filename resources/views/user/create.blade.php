@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">昵称</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="truename" class="col-md-4 control-label">真实姓名</label>
                            <div class="col-md-6">
                                <input required type="text" class="form-control" id="truename" name="truename" value='{{ $user->truename }}' />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">手机号码</label>
                            <div class="col-md-6">
                                <input required type="text" class="form-control" id="phone" name="phone" value='{{ $user->phone }}' />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="hobby" class="col-md-4 control-label">兴趣爱好</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="hobby" name="hobby" value='{{ $user->hobby }}' />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="intro" class="col-md-4 control-label">个性签名</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="intro" name="intro" value='{{ $user->intro }}' />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
