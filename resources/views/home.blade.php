@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">我创建的活动</div>
                <div class="panel-body">
                    <ul>
                    @foreach ($myevents as $event)
                        <li><a href="/event/{{ $event->event_id }}">{{ $event->event_title }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">我参加的活动</div>
                <div class="panel-body">
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
