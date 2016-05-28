<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class TagController extends Controller
{
    public function show($id){
        $events = DB::table('event_tag')->where('tag_name', $id)->join('events', 'events.event_id', '=', 'event_tag.event_id')->select('events.*')->get();
        return view('event.tagshow', ['tag' => $id, 'events' => $events]);
    }
}
